<?php

namespace App\Controller;

use App\Entity\PartnerStatus;
use App\Form\PartnerStatusType;
use App\Repository\PartnerStatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/partner_status")
 */
class PartnerStatusController extends AbstractController
{
    /**
     * @Route("/", name="partner_status_index", methods={"GET"})
     */
    public function index(PartnerStatusRepository $partnerStatusRepository): Response
    {
        return $this->render('partner_status/index.html.twig', [
            'partner_statuses' => $partnerStatusRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="partner_status_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $partnerStatus = new PartnerStatus();
        $form = $this->createForm(PartnerStatusType::class, $partnerStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($partnerStatus);
            $entityManager->flush();

            return $this->redirectToRoute('partner_status_index');
        }

        return $this->render('partner_status/new.html.twig', [
            'partner_status' => $partnerStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partner_status_show", methods={"GET"})
     */
    public function show(PartnerStatus $partnerStatus): Response
    {
        return $this->render('partner_status/show.html.twig', [
            'partner_status' => $partnerStatus,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="partner_status_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PartnerStatus $partnerStatus): Response
    {
        $form = $this->createForm(PartnerStatusType::class, $partnerStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partner_status_index');
        }

        return $this->render('partner_status/edit.html.twig', [
            'partner_status' => $partnerStatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partner_status_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PartnerStatus $partnerStatus): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partnerStatus->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($partnerStatus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('partner_status_index');
    }
}
