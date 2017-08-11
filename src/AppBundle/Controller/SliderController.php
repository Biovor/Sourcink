<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Slider;
use AppBundle\Form\HeaderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Slider controller.
 *
 * @Route("admin/slider")
 */
class SliderController extends Controller
{
    /**
     * Lists all slider entities.
     *
     * @Route("/", name="slider_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sliders = $em->getRepository('AppBundle:Slider')->findAll();

        return $this->render('Admin/slider/index.html.twig', array(
            'sliders' => $sliders,
        ));
    }

    /**
     * Creates a new slider entity.
     *
     * @Route("/new", name="slider_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $slider = new Slider();
        $form = $this->createForm(HeaderType::class, $slider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($slider);
            $em->flush();

            return $this->redirectToRoute('slider_index');
        }

        return $this->render('Admin/slider/new.html.twig', array(
            'slider' => $slider,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing slider entity.
     *
     * @Route("/{id}/edit", name="slider_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Slider $slider)
    {
        $deleteForm = $this->createDeleteForm($slider);
        $editForm = $this->createForm(HeaderType::class, $slider);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('slider_index');
        }

        return $this->render('Admin/slider/edit.html.twig', array(
            'slider' => $slider,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a slider entity.
     *
     * @Route("/{id}", name="slider_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Slider $slider)
    {
        $form = $this->createDeleteForm($slider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($slider);
            $em->flush();
        }

        return $this->redirectToRoute('slider_index');
    }

    /**
     * Creates a form to delete a slider entity.
     *
     * @param Slider $slider The slider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Slider $slider)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('slider_delete', array('id' => $slider->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
