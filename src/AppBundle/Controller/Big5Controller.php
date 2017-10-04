<?php
/**
 * Created by PhpStorm.
 * User: biovor
 * Date: 22/09/17
 * Time: 09:57
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Big5;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Stream;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;
use AppBundle\Services\Api;



class Big5Controller extends Controller
{
    /**
     * @Route("candidat/big5", name="big5")
     */
    public function big5Action()
    {

        return $this->render(
            'AppBundle:MonkeyTie:big5.html.twig');

    }

    /**
     * @Route("big5/response", name="big5Rep")
     */
    public function big5RepAction(Request $request, Api $api)
    {
        if($request->getContent() != null ) {
            $json = json_decode($request->getContent());

            $big5 = new big5();
            if (isset($json->userId)) {
                $big5->setUserId($json->userId);
            }
            if (isset($json->token)) {
                $big5->setToken($json->token);
            }
            if (isset($json->validity)) {
                $big5->setValidity($json->validity);
            }
            if (isset($json->traits->extraversion)) {
                $big5->setExtraversion($json->traits->extraversion);
            }
            if (isset($json->traits->openness)) {
                $big5->setOpenness($json->traits->openness);
            }
            if (isset($json->traits->neuroticism)) {
                $big5->setNeuroticism($json->traits->neuroticism);
            }
            if (isset($json->traits->conscientiousness)) {
                $big5->setConscientiouness($json->traits->conscientiousness);
            }
            if (isset($json->traits->agreeableness)) {
                $big5->setAgreeableness($json->traits->agreeableness);
            }
            if (isset($json->archetype->title)) {
                $big5->setTitle($json->archetype->title);
            }
            if (isset($json->archetype->displayName)) {
                $big5->setDisplayName($json->archetype->displayName);
            }
            if (isset($json->archetype->iconUrl)) {
                $big5->setIconUrl($json->archetype->iconUrl);
            }
            if (isset($json->archetype->description)) {
                $big5->setDescription($json->archetype->description);
            }
            if (isset($json->pdfReport)) {
                $big5->setPdfReport($json->pdfReport);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($big5);
            $em->flush();

            $this->big5PDFAction($api, $json->userId);
        }

        return $this->redirectToRoute('app_homepage');
    }

    public function big5PDFAction(Api $api, $idBig5){

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->findOneById($idBig5);
        $big5User = $em->getRepository('AppBundle:Big5')->findOneByuserId($idBig5);
        $pdf = base64_decode(utf8_encode($big5User->getPdfReport()));

        header('Content-Type: application/pdf');
        $fp= fopen('big5/big5-'.$big5User->getId().'.pdf', 'w+');
        fwrite($fp, $pdf);
        fclose($fp);

        $user = $api->getSearch('candidates', $user->getEmail());
        $directory = $this->getParameter('kernel.project_dir') . '/web/big5/big5-'.$big5User->getId().'.pdf';
        $api->sendResume2($directory . $this->getUser()->getResumeName(),
            $user->_embedded->candidates[0]->id, $user->_embedded->candidates[0]->first_name,
            $user->_embedded->candidates[0]->last_name);
        unlink($directory . $this->getUser()->getResumeName());


        return $this->redirectToRoute('app_homepage');

    }

}