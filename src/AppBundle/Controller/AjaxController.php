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
    /**
     * @Route(
     *     "/ajax/resume/send",
     *     name="ajax_resume_send",
     * )
     */
    public function resumeSend(Request $request, Api $api)
    {
        if ($request->isXmlHttpRequest()) {
            $origin = 'CV';
            $resume = $request->files->get('resume');
            $api->sendResume($resume, $this->getUser()->getIdCats(),$this->getUser()->getFirstName(),
                $this->getUser()->getLastName(), $origin);
            return new Response(1);
        }
        return $this->redirectToRoute('app_homepage');
    }
}