<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PartnerView;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Partnerview controller.
 *
 * @Route("admin/partnerview")
 */
class PartnerViewController extends Controller
{
    /**
     * Lists all partnerView entities.
     *
     * @Route("/", name="admin_partnerview_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $smallDevices=0;
        $mediumDevices=0;
        $largeDevices=0;

        $partnerViews = $em->getRepository('AppBundle:PartnerView')->findAll();
        foreach ($partnerViews as $partnerView => $view){
            switch ($view->getS()) {
                case 12:
                    $smallDevices=1;
                    break;
                case 6:
                    $smallDevices=2;
                    break;
                case 4:
                    $smallDevices=3;
                    break;
                case 3:
                    $smallDevices=4;
                    break;
                case 2:
                    $smallDevices=6;
                    break;
                case 1:
                    $smallDevices=12;
                    break;
            }

            switch ($view->getM()) {
                case 12:
                    $mediumDevices=1;
                    break;
                case 6:
                    $mediumDevices=2;
                    break;
                case 4:
                    $mediumDevices=3;
                    break;
                case 3:
                    $mediumDevices=4;
                    break;
                case 2:
                    $mediumDevices=6;
                    break;
                case 1:
                    $mediumDevices=12;
                    break;
            }

            switch ($view->getL()) {
                case 12:
                    $largeDevices=1;
                    break;
                case 6:
                    $largeDevices=2;
                    break;
                case 4:
                    $largeDevices=3;
                    break;
                case 3:
                    $largeDevices=4;
                    break;
                case 2:
                    $largeDevices=6;
                    break;
                case 1:
                    $largeDevices=12;
                    break;
            }
    }
        return $this->render('Admin/partnerview/index.html.twig', array(
            'partnerViews' => $partnerViews,
            'smallDevices'=>$smallDevices,
            'mediumDevices'=>$mediumDevices,
            'largeDevices'=>$largeDevices,
        ));
    }

    /**
     * Creates a new partnerView entity.
     *
     * @Route("/new", name="admin_partnerview_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $partnerView = new Partnerview();
        $form = $this->createForm('AppBundle\Form\PartnerViewType', $partnerView);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partnerView);
            $em->flush();

            return $this->redirectToRoute('partner_index', array('id' => $partnerView->getId()));
        }

        return $this->render('Admin/partnerview/new.html.twig', array(
            'partnerView' => $partnerView,
            'form' => $form->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing partnerView entity.
     *
     * @Route("/{id}/edit", name="admin_partnerview_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PartnerView $partnerView)
    {
        $editForm = $this->createForm('AppBundle\Form\PartnerViewType', $partnerView);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partner_index', array('id' => $partnerView->getId()));
        }

        return $this->render('Admin/partnerview/edit.html.twig', array(
            'partnerView' => $partnerView,
            'form' => $editForm->createView(),
        ));
    }

}
