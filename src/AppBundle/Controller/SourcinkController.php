<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sourcink;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Sourcink controller.
 *
 * @Route("admin007UvTx037/sourcink")
 */
class SourcinkController extends Controller
{
    /**
     * Lists all sourcink entities.
     *
     * @Route("/", name="sourcink_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sourcinks = $em->getRepository('AppBundle:Sourcink')->findAll();

        return $this->render('Admin/sourcink/index.html.twig', array(
            'sourcinks' => $sourcinks,
        ));
    }

    /**
     * Displays a form to edit an existing sourcink entity.
     *
     * @Route("/{id}/edit", name="sourcink_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sourcink $sourcink)
    {
        $editForm = $this->createForm('AppBundle\Form\SourcinkType', $sourcink);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sourcink_index');
        }

        return $this->render('Admin/sourcink/edit.html.twig', array(
            'sourcink' => $sourcink,
            'edit_form' => $editForm->createView(),
        ));
    }


}
