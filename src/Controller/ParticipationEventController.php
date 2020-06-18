<?php

namespace App\Controller;

use App\Entity\ParticipationEvent;
use App\Form\ParticipationEventType;
use App\Repository\ParticipationEventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/participation_event")
 */
class ParticipationEventController extends AbstractController
{
    /**
     * @Route("/", name="participation_event_index", methods={"GET"})
     */
    public function index(ParticipationEventRepository $participationEventRepository): Response
    {
        return $this->render('participation_event/index.html.twig', [
            'participation_events' => $participationEventRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="participation_event_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $participationEvent = new ParticipationEvent();
        $form = $this->createForm(ParticipationEventType::class, $participationEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($participationEvent);
            $entityManager->flush();

            return $this->redirectToRoute('participation_event_index');
        }

        return $this->render('participation_event/new.html.twig', [
            'participation_event' => $participationEvent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="participation_event_show", methods={"GET"})
     */
    public function show(ParticipationEvent $participationEvent): Response
    {
        return $this->render('participation_event/show.html.twig', [
            'participation_event' => $participationEvent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="participation_event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ParticipationEvent $participationEvent): Response
    {
        $form = $this->createForm(ParticipationEventType::class, $participationEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('participation_event_index');
        }

        return $this->render('participation_event/edit.html.twig', [
            'participation_event' => $participationEvent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="participation_event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ParticipationEvent $participationEvent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participationEvent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($participationEvent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('participation_event_index');
    }
}
