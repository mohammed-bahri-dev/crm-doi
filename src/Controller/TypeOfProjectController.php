<?php

namespace App\Controller;

use App\Entity\TypeOfProject;
use App\Form\TypeOfProjectType;
use App\Repository\TypeOfProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type_of_project")
 */
class TypeOfProjectController extends AbstractController
{
    /**
     * @Route("/", name="type_of_project_index", methods={"GET"})
     */
    public function index(TypeOfProjectRepository $typeOfProjectRepository): Response
    {
        return $this->render('type_of_project/index.html.twig', [
            'type_of_projects' => $typeOfProjectRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_of_project_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeOfProject = new TypeOfProject();
        $form = $this->createForm(TypeOfProjectType::class, $typeOfProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeOfProject);
            $entityManager->flush();

            return $this->redirectToRoute('type_of_project_index');
        }

        return $this->render('type_of_project/new.html.twig', [
            'type_of_project' => $typeOfProject,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_of_project_show", methods={"GET"})
     */
    public function show(TypeOfProject $typeOfProject): Response
    {
        return $this->render('type_of_project/show.html.twig', [
            'type_of_project' => $typeOfProject,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_of_project_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeOfProject $typeOfProject): Response
    {
        $form = $this->createForm(TypeOfProjectType::class, $typeOfProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_of_project_index');
        }

        return $this->render('type_of_project/edit.html.twig', [
            'type_of_project' => $typeOfProject,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_of_project_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeOfProject $typeOfProject): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeOfProject->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeOfProject);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_of_project_index');
    }
}
