<?php

namespace App\Controller;

use App\Entity\TypeOfCaEntity;
use App\Form\TypeOfCaEntityType;
use App\Repository\TypeOfCaEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entity_type")
 */
class TypeOfCaEntityController extends AbstractController
{
    /**
     * @Route("/", name="type_of_ca_entity_index", methods={"GET"})
     */
    public function index(TypeOfCaEntityRepository $typeOfCaEntityRepository): Response
    {
        return $this->render('type_of_ca_entity/index.html.twig', [
            'type_of_ca_entities' => $typeOfCaEntityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_of_ca_entity_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeOfCaEntity = new TypeOfCaEntity();
        $form = $this->createForm(TypeOfCaEntityType::class, $typeOfCaEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeOfCaEntity);
            $entityManager->flush();

            return $this->redirectToRoute('type_of_ca_entity_index');
        }

        return $this->render('type_of_ca_entity/new.html.twig', [
            'type_of_ca_entity' => $typeOfCaEntity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_of_ca_entity_show", methods={"GET"})
     */
    public function show(TypeOfCaEntity $typeOfCaEntity): Response
    {
        return $this->render('type_of_ca_entity/show.html.twig', [
            'type_of_ca_entity' => $typeOfCaEntity,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_of_ca_entity_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeOfCaEntity $typeOfCaEntity): Response
    {
        $form = $this->createForm(TypeOfCaEntityType::class, $typeOfCaEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_of_ca_entity_index');
        }

        return $this->render('type_of_ca_entity/edit.html.twig', [
            'type_of_ca_entity' => $typeOfCaEntity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_of_ca_entity_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeOfCaEntity $typeOfCaEntity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeOfCaEntity->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeOfCaEntity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_of_ca_entity_index');
    }
}
