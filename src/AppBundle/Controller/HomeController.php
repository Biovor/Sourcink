<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Services\Api;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homeAction(Api $api, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $videos = $em->getRepository('AppBundle:Header')->findAll();
        $categories = $em->getRepository('AppBundle:Category')->findAll();
        $team = $em->getRepository('AppBundle:Team')->findAll();
        $partners = $em->getRepository('AppBundle:Partner')->findAll();
        $photos = $em->getRepository('AppBundle:Slider')->findAll();
        $sourcink = $em->getRepository('AppBundle:Sourcink')->find(1);
        $partnerViews = $em->getRepository('AppBundle:PartnerView')->findAll();
        $textsFooter = $em->getRepository('AppBundle:Text')->findAll();

        $data = $api->getJob();

        foreach ($data->_embedded->jobs as $job) {
            $offers[$job->id] = [
                'title' => $job->title,
                'duration' => $job->duration,
                'description' => $job->description,
                'city' => $job->location->city,
                'updated' => $job->date_modified,
                'statut' => $job->_embedded->status->title,
                'maj' => $job->date_modified,
                'debut' => $job->start_date,
                'id' => $job->id,
                'attachment_id' => (property_exists($job->_embedded, 'attachments') ? $job->_embedded->attachments[0]->id : '')

            ];
            if ($offers[$job->id]['attachment_id'] != '') {

                $offers[$job->id]['image'] = $api->downloadImg(property_exists($job->_embedded, 'attachments') ? $job->_embedded->attachments[0]->id : '');

            }
        }

        $browser = $request->server->get('HTTP_USER_AGENT');

        if (preg_match('/Edge/', $browser)) {
            $browser = 'Edge/IE';
        }
        if (preg_match('/MSIE/',$browser)) {
            $browser = 'Edge/IE';
        }
        if (preg_match('/Trident/',$browser)) {
            $browser = 'Edge/IE';
        }

        return $this->render(
            'AppBundle:Home:home.html.twig',
            [
                'offers' => $offers,
                'videos' => $videos,
                'photos' => $photos,
                'categories' => $categories,
                'team' => $team,
                'browser'=>$browser,
                'partners'=>$partners,
                'sourcink' =>$sourcink,
                'partnerViews' =>$partnerViews,
                'textsFooter' =>$textsFooter
            ]
        );
    }

    /**
     * @Route("/lesTests", name="les_tests")
     */
    public function testAction()
    {
        if($this->isGranted('ROLE_USER')){
            return $this->redirectToRoute('app_applicant');
        } else {
            return $this->render('AppBundle:Home:home-tests.html.twig');
        }
    }
}


