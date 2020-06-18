<?php

namespace App\Controller;

use App\Entity\EventProject;
use App\Form\EventProjectType;
use App\Repository\EventProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event_project")
 */
class EventProjectController extends AbstractController
{
    /**
     * @Route("/", name="event_project_index", methods={"GET"})
     */
    public function index(EventProjectRepository $eventProjectRepository): Response
    {
        return $this->render('event_project/index.html.twig', [
            'event_projects' => $eventProjectRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="event_project_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $eventProject = new EventProject();
        $form = $this->createForm(EventProjectType::class, $eventProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($eventProject);
            $entityManager->flush();

            return $this->redirectToRoute('event_project_index');
        }

        return $this->render('event_project/new.html.twig', [
            'event_project' => $eventProject,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_project_show", methods={"GET"})
     */
    public function show(EventProject $eventProject): Response
    {
        return $this->render('event_project/show.html.twig', [
            'event_project' => $eventProject,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="event_project_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EventProject $eventProject): Response
    {
        $form = $this->createForm(EventProjectType::class, $eventProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_project_index');
        }

        return $this->render('event_project/edit.html.twig', [
            'event_project' => $eventProject,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_project_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EventProject $eventProject): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eventProject->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($eventProject);
            $entityManager->flush();
        }

        return $this->redirectToRoute('event_project_index');
    }
}
