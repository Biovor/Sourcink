<?php
namespace AppBundle\Controller;


use AppBundle\Entity\CultureFit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;
use AppBundle\Services\Api;

class CultureFitController extends Controller{

    /**
     * @Route(" candidat/cultureFit", name="cult_F")
     */
    public function cultureFitAction()
    {

        return $this->render(
            'AppBundle:MonkeyTie:cultureFit.html.twig');
    }

    /**
     * @Route("culturefit/response", name="cultFRep")
     */
    public function cultFRepAction(Request $request)
    {
        if($request->getContent() != null ) {
            $token = $this->container->getParameter('api_tie_culture_key');
            $json = json_decode($request->getContent());


            if (isset($json->token) AND $json->token === $token) {
                $idUser = $json->userId;
                $cultF = new cultureFit();

                $cultF->setToken($json->token);

                if (isset($json->userId)) {
                    $cultF->setUserId($idUser);
                }
                if (isset($json->results->remuAvt)) {
                    $cultF->setRemuAvt(round($json->results->remuAvt));
                }
                if (isset($json->results->formEvo)) {
                    $cultF->setFormEvo(round($json->results->formEvo));
                }
                if (isset($json->results->recoMgt)) {
                    $cultF->setRecoMgt(round($json->results->recoMgt));
                }
                if (isset($json->results->exp)) {
                    $cultF->setExp(round($json->results->exp));
                }
                if (isset($json->results->respCha)) {
                    $cultF->setRespCha(round($json->results->respCha));
                }
                if (isset($json->results->devEga)) {
                    $cultF->setDevEga(round($json->results->devEga));
                }
                if (isset($json->results->creaInno)) {
                    $cultF->setCreaInno(round($json->results->creaInno));
                }
                if (isset($json->results->teamAmb)) {
                    $cultF->setTeamAmb(round($json->results->teamAmb));
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($cultF);
                $em->flush();

                $cats = $this->forward('AppBundle:CultureFit:cultureFitCats', array(
                    'idUser' => $idUser
                ));

                return $cats;
            }
        }
        return $this->redirectToRoute('app_homepage');
    }

    public function cultureFitCatsAction(Api $api, $idUser){

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->findOneById($idUser);
        $CFUsers = $em->getRepository('AppBundle:CultureFit')->findByuserId($idUser);
        $CFUser = end($CFUsers);

        $userCats = $api->getSearch('candidates', $user->getEmail());
        $api->updateCandiCultureFit($CFUser,$user,$userCats->_embedded->candidates[0]->id);


        return $this->redirectToRoute('app_homepage');
    }

}