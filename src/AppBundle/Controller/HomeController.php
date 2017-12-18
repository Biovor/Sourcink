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
            ]
        );
    }

    /**
     * @Route("/TestsDePersonnalite", name="les_tests")
     */
    public function testAction()
    {
        if($this->isGranted('ROLE_USER')){
            return $this->redirectToRoute('app_applicant');
        } else {
            return $this->render('AppBundle:Home:home-tests.html.twig');
        }
    }


    /**
     * @Route("cats/rWoui45Sd78", name="hookCandidat")
     */
    public function webHooksCandidatAction(Request $request, Api $api)
    {
//        if($request->getContent() != null ) {
            $cache = new FilesystemCache();


        if (!$cache->has('requestaction')) {
            $cache->set('requestaction', $request->getContent(), 200005);
        }


            $token = $this->container->getParameter('secret_hook_cats');


            $tab =json_decode($cache->get('requestaction'));

//            var_dump($tab->event);
           $userData = $tab->_embedded->candidate;


        var_dump($userData->first_name);
        var_dump($userData->last_name);
        var_dump($userData->title);
        var_dump($userData->emails->primary);
        var_dump($userData->phones->cell);
        var_dump($userData->current_pay);
        var_dump($userData->desired_pay);
        var_dump($userData->_embedded->custom_fields->_embedded);
//            if ($field->_embedded->definition->name == self::mobility) {
//                var_dump($field->value);
//
//                $regions = array();
//                foreach ($field->_embedded->definition->field->selections as $region){
//                    $regions[$region->label] = $region->id;
//                }
//                $regions = array_flip($regions);
//
//                $mobilities = array();
//                foreach ($field->value as $mobility) {
//                    $mobilities[] = $regions[$mobility];
//                }
//                var_dump($mobilities);
//            } else if ($field->_embedded->definition->name == self::wanted_job) {
//                var_dump($field->value);
//            } else if ($field->_embedded->definition->name == self::experience) {
//                var_dump($field->value);
//            }




            die();




            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository('UserBundle:User')->findOneByIdCats($idUser);

            $api->updateCandidateFromCats($user, $userCats);

//            }

        return $this->redirectToRoute('app_homepage');
        return $this->render(
            'AppBundle:MonkeyTie:hookdump.html.twig');
    }

//    public function big5PDFAction(Api $api, $idUser)
//    {
//        $em = $this->getDoctrine()->getManager();
//        $user = $em->getRepository('UserBundle:User')->findOneById($idUser);
//        $big5User = $em->getRepository('AppBundle:Big5')->findOneByuserId($idUser);
//        $user->setBig5(true);
//        $em->persist($user);
//        $em->flush();
//        $pdf = base64_decode($big5User->getPdfReport());
//
//        header('Content-Type: application/pdf');
//        $fp= fopen('big5/big5-'.$big5User->getId().'.pdf', 'w+');
//        fwrite($fp, $pdf);
//        fclose($fp);
//        $origin = 'Big5';
//        $directory = 'big5/big5-'.$big5User->getId().'.pdf';
//        $api->tagCandidate($user->idCats, $this->getParameter('id_tag_candidate_big5'));
//        $api->sendResume($directory . $user->getResumeName(),
//            $user->id, $user->first_name, $user->last_name, $origin);
//        unlink($directory . $user->getResumeName());
//
//        return $this->redirectToRoute('app_homepage');
//    }

}


