<?php

namespace App\Controller;

use App\Entity\TypeOfEventProject;
use App\Form\TypeOfEventProjectType;
use App\Repository\TypeOfEventProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type_of_event_project")
 */
class TypeOfEventProjectController extends AbstractController
{
    /**
     * @Route("/", name="type_of_event_project_index", methods={"GET"})
     */
    public function index(TypeOfEventProjectRepository $typeOfEventProjectRepository): Response
    {
        return $this->render('type_of_event_project/index.html.twig', [
            'type_of_event_projects' => $typeOfEventProjectRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_of_event_project_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeOfEventProject = new TypeOfEventProject();
        $form = $this->createForm(TypeOfEventProjectType::class, $typeOfEventProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeOfEventProject);
            $entityManager->flush();

            return $this->redirectToRoute('type_of_event_project_index');
        }

        return $this->render('type_of_event_project/new.html.twig', [
            'type_of_event_project' => $typeOfEventProject,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_of_event_project_show", methods={"GET"})
     */
    public function show(TypeOfEventProject $typeOfEventProject): Response
    {
        return $this->render('type_of_event_project/show.html.twig', [
            'type_of_event_project' => $typeOfEventProject,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_of_event_project_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeOfEventProject $typeOfEventProject): Response
    {
        $form = $this->createForm(TypeOfEventProjectType::class, $typeOfEventProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_of_event_project_index');
        }

        return $this->render('type_of_event_project/edit.html.twig', [
            'type_of_event_project' => $typeOfEventProject,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_of_event_project_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeOfEventProject $typeOfEventProject): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeOfEventProject->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeOfEventProject);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_of_event_project_index');
    }
}
