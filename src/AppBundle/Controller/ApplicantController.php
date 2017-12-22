<?php

namespace AppBundle\Controller;

use AppBundle\Form\ProfileType;
use AppBundle\Services\Api;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @Route("/candidat")
 */
class ApplicantController extends Controller
{
    /**
     * @Route("/", name="app_applicant")
     */
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $metaDescription = $em->getRepository('AppBundle:Text')->findOneBy(array('location'=>'Meta-Candidat'));
        return $this->render('AppBundle:Applicant:home.html.twig', [
            'metaDescription' =>$metaDescription
        ]);
    }

    /**
     * @Route("/update", name="applicant_update")
     */
    public function updateAction(Request $request, Api $api)
    {
        $cache = new FilesystemCache();

        if (!$cache->has('regions')){
            ////*****1 Appel API*****////
            $regions = $api->getRegions();
            $cache ->set('regions', $regions, $this->getParameter('temp_cache_regions'));
        }
        $regions = $cache-> get('regions');

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ProfileType::class, $this->getUser(), array('regions' => $regions));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            ////*****1 Appel API*****////
            $catsUser = $this->userCatsIdentificationAction($api);
            if (empty($this->getUser()->getMobility())) {
                $value[]=(reset($regions));
                $this->getUser()->setMobility($value);
            };
            if (isset($catsUser->count) && $catsUser->count === 0) {
                ////*****4-5 Appel API*****//// Création user
                $api->createCandidateUser($this->getUser());
                $newUser = $this->userCatsIdentificationAction($api);
                $i = 0;
                while (!isset($newUser->id) && $i < $this->getParameter('try_create_candidate')) {
                    $newUser = $this->userCatsIdentificationAction($api);
                    $i++;
                }
                if (isset($newUser->id)) {
                    $api->tagCandidate($newUser->id, $this->getParameter('id_tag_candidate_web'));
                    $em->persist($this->getUser()->setIdCats($newUser->id));
                }
            } else {
                ////*****1 Appel API*****//// Mise à jour user
                $CFUsers = $em->getRepository('AppBundle:CultureFit')->findByuserId($this->getUser());
                $cultureFit = end($CFUsers);
                $api->updateCandidate($this->getUser(), $catsUser->id, $cultureFit);

                if (is_null($this->getUser()->getIdCats())) {
                $this->getUser()->setIdCats($catsUser->id);
                $api->tagCandidate($catsUser->id, $this->getParameter('id_tag_candidate_web'));
                }
            }
            $this->getUser()->setStatus(true);
            $em->persist($data);
            $this->addFlash('success', 'Vos informations ont été mises à jour.');
            $em->flush();
            return $this->redirectToRoute('app_applicant');
        }

        return $this->render('AppBundle:Applicant:update.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/update/cv", name="applicant_update_cv")
     */
    public function updateCvAction()
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($this->getUser()->setHasResume(true));
        $em->flush();
        return $this->redirectToRoute('app_applicant');
    }

    /**
     * @Route("/delete", name="applicant_delete")
     */
    public function deleteAction(Api $api)
    {
        $user = $this->userCatsIdentificationAction($api);
        if ($user->id) {
            $api->deleteCandidate($user->id);
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($this->getUser());
        $em->flush();
        return $this->redirectToRoute('app_homepage');
    }


    public function userCatsIdentificationAction(Api $api)
    {
        $em = $this->getDoctrine()->getManager();

        if (!empty($this->getUser()->getIdCats()) ){
            ////*****1 Appel API*****////
            $catsUser = $api->getId('candidates',$this->getUser()->getIdCats());
        }
        ////*****1 Appel API*****////
        else { $catsUser = $api->getSearch('candidates', $this->getUser()->getEmail());

            if ($catsUser->count > 0) {
                $catsUser = $catsUser->_embedded->candidates[0];
            }
        }

        if (empty( $catsUser->_embedded->attachments)) {
            $resume = false;
            foreach ($catsUser->_embedded->attachments as $attachment) {
                if ($attachment->is_resume === true){
                   $resume = true;
                }
            }
            if ($resume == false){
                $em->persist($this->getUser()->setHasResume(false));
            }
        }

        return $catsUser;
    }
}


