<?php

namespace AppBundle\Controller;

use AppBundle\Form\ProfileType;
use AppBundle\Services\Api;
use AppBundle\Services\MonkeyTie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
    public function homeAction(Api $api)
    {
        $em = $this->getDoctrine()->getManager();
        $catsUser = $api->getSearch('candidates', $this->getUser()->getEmail());
        $hasResume = false;
        $big5User = $em->getRepository('AppBundle:Big5')->findOneByuserId($this->getUser());
        $pdf = 0;

        if ($big5User != null){
            $pdf = 1;
        }
        if ($catsUser->count > 0) {
            $api->updateCandidateFromCats($this->getUser(), $catsUser->_embedded->candidates[0]);
            $hasResume = $api->hasResume($catsUser->_embedded->candidates[0]->id);
        }
        $mobilities = array();
        if($this->getUser()->getMobility()!=null) {
            $regions = $api->getRegions();
            $regions = array_flip($regions);
            foreach ($this->getUser()->getMobility() as $mobility) {
                $mobilities[] = $regions[$mobility];
            }
        }

        return $this->render('AppBundle:Applicant:home.html.twig', [
            'status' => $catsUser->count,
            'hasResume' => $hasResume,
            'mobilities' => $mobilities,
            'pdf' => $pdf
        ]);
    }

    /**
     * @Route("/update", name="applicant_update")
     */
    public function updateAction(Request $request, Api $api)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ProfileType::class, $this->getUser(), array('regions' => $api->getRegions()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em->persist($data);
            $em->flush();
            $catsUser = $api->getSearch('candidates', $this->getUser()->getEmail());
            $this->addFlash('success', 'Vos informations ont été mises à jour.');
            if ($catsUser->count == 0) {
                $tag = $api->getTag($this->getParameter('tag_candidate'));
                $api->createCandidateUser($this->getUser());
                $newUser = $api->getSearch('candidates', $this->getUser()->getEmail());
                $i = 0;
                while ($newUser->count === 0 && $i < $this->getParameter('try_create_candidate')) {
                    $newUser = $api->getSearch('candidates', $this->getUser()->getEmail());
                    $i++;
                }
                if ($newUser->count > 0) {
                    $api->tagCandidate($newUser->_embedded->candidates[0]->id, $tag);
                    if ($this->getUser()->getResumeName() != null) {
                        $directory = $this->getParameter('kernel.project_dir') . '/web/cv/';
                        $api->sendResume($directory . $this->getUser()->getResumeName(),
                            $newUser->_embedded->candidates[0]->id, $newUser->_embedded->candidates[0]->first_name, $newUser->_embedded->candidates[0]->last_name);
                        unlink($directory . $this->getUser()->getResumeName());
                    }

                }
            } else {
                $CFUsers = $em->getRepository('AppBundle:CultureFit')->findByuserId($this->getUser());
                $cultureFit = end($CFUsers);
                $api->updateCandidate($this->getUser(), $catsUser->_embedded->candidates[0], $cultureFit);
            }
            return $this->redirectToRoute('app_applicant');

        }
        return $this->render('AppBundle:Applicant:update.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/delete", name="applicant_delete")
     */
    public function deleteAction(Api $api)
    {
        $user = $api->getSearch('candidates', $this->getUser()->getEmail());
        if ($user->count > 0) {
            $api->deleteCandidate($user->_embedded->candidates[0]->id);
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($this->getUser());
        $em->flush();
        return $this->redirectToRoute('app_homepage');
    }


}


