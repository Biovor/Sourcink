<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Texts;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Texts controller.
 *
 * @Route("admin007UvTx037/texts")
 */
class TextsController extends Controller
{
    /**
     * Lists all texts entities.
     *
     * @Route("/", name="admin_texts_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $texts = $em->getRepository('AppBundle:Texts')->findAll();

        return $this->render('Admin/texts/index.html.twig', array(
            'texts' => $texts,
        ));
    }

    /**
     * Creates a new texts entity.
     *
     * @Route("/new", name="admin_texts_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $texts = new Texts();
        $form = $this->createForm('AppBundle\Form\TextsType', $texts);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($texts);
            $em->flush();

            return $this->redirectToRoute('admin_texts_index', array('id' => $texts->getId()));
        }

        return $this->render('Admin/texts/new.html.twig', array(
            'texts' => $texts,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing texts entity.
     *
     * @Route("/{id}/edit", name="admin_texts_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Texts $texts)
    {
        $deleteForm = $this->createDeleteForm($texts);
        $editForm = $this->createForm('AppBundle\Form\TextsType', $texts);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_texts_index');
        }

        return $this->render('Admin/texts/edit.html.twig', array(
            'texts' => $texts,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a texts entity.
     *
     * @Route("/{id}", name="admin_texts_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Texts $texts)
    {
        $form = $this->createDeleteForm($texts);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($texts);
            $em->flush();
        }

        return $this->redirectToRoute('admin_texts_index');
    }

    /**
     * Creates a form to delete a texts entity.
     *
     * @param Texts $texts The texts entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Texts $texts)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_texts_delete', array('id' => $texts->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function footerAction()
    {
        $em = $this->getDoctrine()->getManager();
        $textsFooter = $em->getRepository('AppBundle:Texts')->findAll();

        return $this->render('AppBundle:Base:cgv-ml.html.twig', array(
            'textsFooter' => $textsFooter
        ));

    }
}
