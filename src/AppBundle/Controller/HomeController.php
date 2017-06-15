<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Services\Api;

class HomeController extends Controller
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homeAction(Api $service)
    {
<<<<<<< HEAD
        $em = $this->getDoctrine()->getManager();
        $videos =  $em->getRepository('AppBundle:Header')->findAll();
        $categories =  $em->getRepository('AppBundle:Category')->findAll();
        $team =  $em->getRepository('AppBundle:Team')->findAll();
        $data = $service->api('jobs', ["field: duration", "filter: contains", "value: rejected", "custom_fields"]);
        $i = 1;
=======
        $data = $service->api('jobs',[ "field: duration", "filter: contains", "value: rejected", "custom_fields"]);

>>>>>>> c51a97d0325e1ce3163909d2a2c68ed57b006e60
        foreach ($data->_embedded->jobs as $job) {
            $offers[$job->id] = [
                'title' => $job->title,
                'duration' => $job->duration,
                'description' => $job->description,
                'city' => $job->location->city,
                'statut'=>$job->_embedded->status->title,
                'maj' => $job->date_modified,
               // 'contrat' => $job -> contract,
            ];



        }
        //dump($data);
        //die();
        return $this->render('AppBundle:Home:home.html.twig',
            ['offers'=>$offers, 'videos'=>$videos, 'categories'=>$categories, 'team'=>$team]);
    }
}
