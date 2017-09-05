<?php
/**
 * Created by PhpStorm.
 * User: biovor
 * Date: 04/09/17
 * Time: 14:42
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\ApiTie;
use UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * @Route("/big5", name="app_big5")
 */
class Big5Controller extends Controller
{

    /**
     * @Route("/")
     */
    public function big5Action(ContainerBuilder $container)
    {
        $container->compile();
        $container->getParameter('api_tie_big5_key');

        dump($container);
        die;

//        $apiTie->setApiTieUrlInit($container->getParameter('api_tie_url_init'))->setApiTieBig5Key($container->
//        getParameter( 'api_tie_big5_key'))->setCallback($container->getParameter( 'callback'))->setUserId($user->getId())
//            ->setUserMail($user->getEmail());

//        $apiTie->requestBigFive();
//        dump($apiTie);
//        die;
//
//        return $this->render(
//            'AppBundle:Home:home.html.twig',[]);
    }
}
