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
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

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
    public function big5RepAction(Request $request)
    {
        if($request->getContent() != null ){
            $json=json_decode($request->getContent());
var_dump($json);
            $big5 = new big5();
            $big5->setUserId($json->userId);
            $big5->setToken($json->token);
            $big5->setValidity($json->validity);
            $big5->setExtraversion($json->traits->extraversion);
            $big5->setOpenness($json->traits->openness);
            $big5->setNeuroticism($json->traits->neuroticism);
            $big5->setConscientiouness($json->traits->conscientiousness);
            $big5->setAgreeableness($json->traits->agreeableness);
            $big5->setTitle($json->archetype->title);
            $big5->setDisplayName($json->archetype->displayName);
            $big5->setIconUrl($json->archetype->iconUrl);
            $big5->setDescription($json->archetype->description);
            if ($json->pdfReport != null) {
                $big5->setPdfReport($json->pdfReport);
            }


            $em = $this->getDoctrine()->getManager();
            $em->persist($big5);
            $em->flush();
        }

        return $this->render(
            'AppBundle:MonkeyTie:rep5.html.twig');
    }
}