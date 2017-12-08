<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Text;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Text controller.
 *
 * @Route("admin007UvTx037/text")
 */
class TextController extends Controller
{
    /**
     * Lists all text entities.
     *
     * @Route("/", name="admin_text_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $texts = $em->getRepository('AppBundle:Text')->findAll();

        return $this->render('Admin/text/index.html.twig', array(
            'texts' => $texts,
        ));
    }

    /**
     * Creates a new text entity.
     *
     * @Route("/new", name="admin_text_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $text = new Text();
        $form = $this->createForm('AppBundle\Form\TextType', $text);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($text);
            $em->flush();

            return $this->redirectToRoute('admin_text_index', array('id' => $text->getId()));
        }

        return $this->render('Admin/text/new.html.twig', array(
            'text' => $text,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing text entity.
     *
     * @Route("/{id}/edit", name="admin_text_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Text $text)
    {
        $deleteForm = $this->createDeleteForm($text);
        $editForm = $this->createForm('AppBundle\Form\TextType', $text);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_text_index');
        }

        return $this->render('Admin/text/edit.html.twig', array(
            'text' => $text,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a text entity.
     *
     * @Route("/{id}", name="admin_text_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Text $text)
    {
        $form = $this->createDeleteForm($text);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($text);
            $em->flush();
        }

        return $this->redirectToRoute('admin_text_index');
    }

    /**
     * Creates a form to delete a text entity.
     *
     * @param Text $text The text entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Text $text)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_text_delete', array('id' => $text->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function footerAction()
    {
        $em = $this->getDoctrine()->getManager();
        $textsFooter = $em->getRepository('AppBundle:Text')->findAll();

        return $this->render('AppBundle:Base:cgv-ml.html.twig', array(
            'textsFooter' => $textsFooter
        ));

    }
}
