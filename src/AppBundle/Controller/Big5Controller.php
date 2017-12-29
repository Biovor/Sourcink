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
use UserBundle\Entity\User;


class Big5Controller extends Controller
{
    /**
     * @Route("candidat/big5", name="big5")
     */
    public function big5Action()
    {
        $em = $this->getDoctrine()->getManager();
        $metaDescription = $em->getRepository('AppBundle:Texts')->findOneBy(array('location'=>'Meta-Big5'));
        if ($metaDescription->getPicture() !== null){
            $metaDescription->setPicture($metaDescription->getPicture()->getPictureName());
        };
        return $this->render(
            'AppBundle:MonkeyTie:big5.html.twig',[
            'metaDescription' =>$metaDescription
        ]);
    }

    /**
     * @Route("big5/response", name="big5Rep")
     */
    public function big5RepAction(Request $request)
    {
        if($request->getContent() != null ) {
            $token = $this->container->getParameter('api_tie_big5_key');
            $json = json_decode($request->getContent());
            if (isset($json->token) AND $json->token === $token ) {
                $idUser = $json->userId;
                $big5 = new big5();

                $big5->setToken($json->token);

                if (isset($json->userId)) {
                    $big5->setUserId($json->userId);
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

                $cats =$this->forward('AppBundle:Big5:big5PDF', array(
                    'idUser'=>$idUser
                ));

                return $cats;
            }
        }
        return $this->redirectToRoute('app_homepage');
    }

    public function big5PDFAction(Api $api, $idUser)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->findOneById($idUser);
        $big5User = $em->getRepository('AppBundle:Big5')->findOneByuserId($idUser);
        $user->setBig5(true);
        $em->persist($user);
        $em->flush();
        $pdf = base64_decode($big5User->getPdfReport());
        header('Content-Type: application/pdf');
        $fp= fopen('big5/big5-'.$big5User->getId().'.pdf', 'w+');
        fwrite($fp, $pdf);
        fclose($fp);
        $origin = 'Big5';
        $directory = 'big5/big5-'.$big5User->getId().'.pdf';
        $api->sendResume($directory, $user->id, $user->first_name, $user->last_name, $origin);
        unlink($directory);
        $api->tagCandidate($user->getIdCats(), $this->getParameter('id_tag_candidate_big5'));

        return $this->redirectToRoute('app_homepage');
    }

    /**
     * @Route("candidat/big5/pdf", name="big5pdf")
     */
    public function pdfReadAction()
    {
        $em = $this->getDoctrine()->getManager();
        $big5User = $em->getRepository('AppBundle:Big5')->findOneByuserId($this->getUser());
        $pdf = base64_decode($big5User->getPdfReport());
        header('Content-Type: application/pdf');
        print_r($pdf);
    }

    /**
     *
     * @Route("/big", name="big5pdf")
     */
    public function pdfAction(Api $api)
    {
        $em = $this->getDoctrine()->getManager();
        $big5User = $em->getRepository('AppBundle:Big5')->findOneByuserId(7);
        $user = $em->getRepository('UserBundle:User')->findOneById(7);

        $origin = 'Big5';
        $directory = 'big5/big5-'.$big5User->getId().'.pdf';
        $api->sendResume($directory, $user->getId(), $user->getFirstname(), $user->getLastname(), $origin);
        unlink($directory);

        return $this->redirectToRoute('app_homepage');
    }
}