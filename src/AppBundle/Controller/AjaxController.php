<?php

namespace AppBundle\Controller;

use AppBundle\Services\Api;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;
use UserBundle\Entity\User;

class AjaxController extends Controller
{
//    /**
//     * @Route(
//     *     "/ajax/resume/parse",
//     *     name="ajax_resume_parse",
//     * )
//     */
//    public function resumeParsing(Request $request, Api $api)
//    {
//        if ($request->isXmlHttpRequest()) {
//            $resume = $request->files->get('resume');
//            $resumeJson = $api->parsing($resume);
//            $fileName = $this->getUser()->getId().'.'.$resume->guessExtension();
//            $directory = $this->getParameter('kernel.project_dir') . '/web/cv';
//            $em = $this->getDoctrine()->getManager();
//            $this->getUser()->setResumeName($fileName);
//            $em->persist($this->getUser());
//            $em->flush();
//            $resume->move($directory, $fileName);
//            return new JsonResponse(array('data' => $resumeJson));
//        }
//        return $this->redirectToRoute('app_homepage');
//    }

    /**
     * @Route(
     *     "/ajax/resume/send",
     *     name="ajax_resume_send",
     * )
     */
    public function resumeSend(Request $request, Api $api)
    {
        if ($request->isXmlHttpRequest()) {
            $resume = $request->files->get('resume');
            $api->sendResume($resume, $this->getUser()->getIdCats(),$this->getUser()->getFirstName(), $this->getUser()->getLastName());
            return new Response(1);
        }
        return $this->redirectToRoute('app_homepage');
    }

}