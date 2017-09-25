<?php
/**
 * Created by PhpStorm.
 * User: biovor
 * Date: 22/09/17
 * Time: 09:57
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


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

        return $this->render(
            'AppBundle:MonkeyTie:big5Rep.html.twig',['request' => $request, 'req' => $_REQUEST]);

    }
}