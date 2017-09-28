<?php
namespace AppBundle\Controller;


use AppBundle\Entity\CultureFit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

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
        if($request->getContent() != null ){
            $json=json_decode($request->getContent());

            $cultF = new cultureFit();
            if (isset($json->userId)) {
                $cultF->setUserId($json->userId);
            }
            if (isset($json->token)) {
                $cultF->setToken($json->token);
            }
            if (isset($json->traits->remuAvt)) {
                $cultF->setRemuAvt($json->results->remuAvt);
            }
            if (isset($json->results->formEvo)) {
                $cultF->setFormEvo($json->results->formEvo);
            }
            if (isset($json->results->recoMgt)) {
                $cultF->setRecoMgt($json->results->recoMgt);
            }
            if (isset($json->results->exp)) {
                $cultF->setExp($json->results->exp);
            }
            if (isset($json->results->respCha)) {
                $cultF->setRespCha($json->results->respCha);
            }
            if (isset($json->results->devEga)) {
                $cultF->setDevEga($json->results->devEga);
            }
            if (isset($json->results->creaInno)) {
                $cultF->setCreaInno($json->results->creaInno);
            }
            if (isset($json->results->teamAmb)) {
                $cultF->setTeamAmb($json->results->teamAmb);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($cultF);
            $em->flush();
        }
        return $this->render(
            'AppBundle:MonkeyTie:repCF.html.twig');
    }

    }