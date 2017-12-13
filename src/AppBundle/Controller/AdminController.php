<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 29/05/17
 * Time: 14:43
 */

namespace AppBundle\Controller;

use AppBundle\Services\Api;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
/**
 * Lists all
 *
 * @Route("/admin007UvTx037", name="admin")
 * @Method("GET")
 */

class AdminController extends Controller
{

    /**
     * Lists all
     *
     * @Route("/",    name="admin_index")
     * @Method("GET")
     */
    public function listAction()
    {
        return $this->render('Admin/indexAdmin.html.twig');
    }

    /**
     * Lists all
     *
     * @Route("/list78541tags",    name="admin_tag")
     * @Method("GET")
     */
    public function idTagsAction(Api $api)
    {
        $tags= $api->getTag();

        return $this->render('Admin/indexTagsAdmin.html.twig', array(
            'tags' => $tags
        ));
    }
}