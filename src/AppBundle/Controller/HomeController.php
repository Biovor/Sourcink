<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Services\Api;
use Symfony\Component\Cache\Simple\FilesystemCache;
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
        $metaDescription = $em->getRepository('AppBundle:Texts')->findOneBy(array('location'=>'Meta-Home'));

        $cache = new FilesystemCache();


        if (!$cache->has('jobs')){
            $jobs = $api->getJob();
            $cache ->set('jobs', $jobs, $this->getParameter('temp_cache_jobs'));
        }

        $jobs = $cache-> get('jobs');

        foreach ($jobs as $job) {
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
                'attachment_id' => (property_exists($job->_embedded, 'attachments') ?
                    $job->_embedded->attachments[0]->id : '')

            ];
            if ($offers[$job->id]['attachment_id'] != '') {

                $offers[$job->id]['image'] = $api->downloadImg(property_exists($job->_embedded, 'attachments')
                    ? $job->_embedded->attachments[0]->id : '');

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
        if ($metaDescription->getPicture() !== null){
            $metaDescription->setPicture($metaDescription->getPicture()->getPictureName());
        };

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
                'metaDescription' =>$metaDescription
            ]
        );
    }

    /**
     * @Route("/TestsDePersonnalite", name="les_tests")
     */
    public function testAction()
    {
        $em = $this->getDoctrine()->getManager();
        $metaDescription = $em->getRepository('AppBundle:Texts')->findOneBy(array('location'=>'Meta-Home'));

        if($this->isGranted('ROLE_USER')){
            return $this->redirectToRoute('app_applicant');
        } else {
            return $this->render('AppBundle:Home:home-tests.html.twig', [
                'metaDescription' =>$metaDescription
            ]);
        }
    }


    /**
     * @Route("cats/rWoui45Sd78", name="hookCandidat")
     */
    public function webHooksCandidatAction(Request $request, Api $api)
    {
//        $cache = new FilesystemCache();
//
//        if (!$cache->has('reques')){
//            $cache ->set('reques', $request, 20000);
//        }
//
//        var_dump($cache->get('reques')->getContent());
//        die();
        $secret =  $this->container->getParameter('secret_hook_cats');
        $webhookBody = $request->getContent();

        // `X-Request-Id` header
        $requestId = $request->server->get('HTTP_X_REQUEST_ID');

        // `X-Signature` header
        $signature = $request->server->get('HTTP_X_SIGNATURE');

        $hash = hash_hmac('sha256', $webhookBody . $requestId, $secret, false);

        if ($signature == 'HMAC-SHA256 ' . $hash) {

            $contentHook =json_decode($request->getContent());

            $userData = $contentHook->_embedded->candidate;

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('UserBundle:User')->findOneByIdCats($userData->id);

            $api->updateCandidateFromCats($user, $userData);
        }

        return $this->redirectToRoute('app_homepage');
    }
}


