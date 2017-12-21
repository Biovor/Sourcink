<?php

namespace AppBundle\Controller;

use AppBundle\Services\Email;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Services\Api;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;



/**
 * @Route("/job", name="app_job")
 */
class JobController extends Controller
{
    const HOMESITE_JOBS = 'Home Site';

    /**
     * @Route("/", name="job_list")
     */
    public function jobAction(Api $api, Request $request)
    {
        $time = time();
        $cache = new FilesystemCache();

        if (!$cache->has('jobs')){
            $jobs = $api->getJob();
            $cache ->set('jobs', $jobs, $this->getParameter('temp_cache_jobs'));
        }

        $jobs = $cache-> get('jobs');

        foreach ($jobs as $job) {

            $offers[$job->id] =
                [
                    'title' => $job->title,
                    'duration' => $job->duration,
                    'description' => $job->description,
                    'city' => trim(ucfirst(strtolower($job->location->city))),
                    'statut' => $job->_embedded->status->title,
                    'maj' => $job->date_modified,
                    'debut' => $job->start_date,
                    'id' => $job->id,
                    'attachment_id' => (property_exists($job->_embedded, 'attachments') ? $job->_embedded->attachments[0]->id : '')
                ];
            if ($offers[$job->id]['attachment_id'] != '') {

                $offers[$job->id]['image'] = $api->downloadImg(property_exists($job->_embedded, 'attachments')
                    ? $job->_embedded->attachments[0]->id : '');
            }
        }

        /**
         * @var $pagination "Knp\Component\Pager\Paginator"
         * */
        $pagination = $this->get('knp_paginator');
        $results = $pagination->paginate(
            $offers,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 9)
        );

        return $this->render(
            'AppBundle:Job:home.html.twig',
            [
                'offers' => $results,
                'time'=> $time
            ]
        );
    }

    /**
     * @Route("/{id}", name="job_page", requirements={"id": "\d+"})
     */
    public function jobPageAction(Api $api, $id, Request $request, \Swift_Mailer $mailer, Email $email)
    {
        $cache = new FilesystemCache();

        $form = $this->createFormBuilder()
            ->setMethod('POST')
            ->add(
                'Postuler', SubmitType::class, array(
                    'label'=> "Postuler",
                    'attr'=>array ('class'=> 'waves-effect waves-light btn red'))
            )

            ->getForm();
        $form->handleRequest($request);

        if (!$cache->has('jobs')){
            $jobs = $api->getJob();
            $cache ->set('jobs', $jobs, $this->getParameter('temp_cache_jobs'));
        }

        $jobs = $cache-> get('jobs');

        foreach ($jobs as $job) {

            if ($job->id == $id){

                if ($form->isValid() && $form->isSubmitted()) {

                    $userId = $this->getUser()->getIdCats();
                    $api->apply($userId, $id);
                    $email->applyJob($mailer, $this->getUser(), $job->title);
                    $this->addFlash('success', 'Nous avons reçu votre candidature. Nous allons vous contacter par e-mail.');
                }

                $offer = [
                    'job' => $job->id,
                    'id' => $job->id,
                    'title' => $job->title,
                    'duration' => $job->duration,
                    'description' => $job->description,
                    'city' => trim(ucfirst(strtolower($job->location->city))),
                    'statut' => $job->_embedded->status->title,
                    'maj' => $job->date_modified,
                    'debut' => $job->start_date,
                    'attachment_id' => (property_exists($job->_embedded, 'attachments') ?
                        $job->_embedded->attachments[0]->id : '')
                ];

                if ($offer['attachment_id'] != '') {

                    $offer['image'] = $api->downloadImg(property_exists($job->_embedded, 'attachments')
                        ? $job->_embedded->attachments[0]->id : '');
                }
            }
        }
        return $this->render(
            'AppBundle:Job:page.html.twig',
            [
                'offer' => $offer,
                'form' => $form->createView(),
            ]
        );
    }
    /**
     * @Route("/spontane", name="job_spontane")
     */
    public function spontaneAction(\Swift_Mailer $mailer, Email $email, API $api)
    {
        $em = $this->getDoctrine()->getManager();
        $CFUsers = $em->getRepository('AppBundle:CultureFit')->findByuserId($this->getUser());
        $cultureFit = end($CFUsers);
        $email->candidatureSpontane($mailer, $this->getUser());
        $api->tagCandidate($this->getUser()->getIdCats(), $this->getParameter('id_tag_candidate_spont'));
        $api->updateCandidate($this->getUser(), $this->getUser()->getIdCats(), $cultureFit);
        $this->getUser()->setSponTime(time());
        $em->flush();
        $this->addFlash('success', 'Nous avons reçu votre candidature. Nous allons vous contacter par e-mail.');
        return $this->redirectToRoute('job_list');
    }
}