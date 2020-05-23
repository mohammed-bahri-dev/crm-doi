<?php

namespace App\Controller;

use App\Entity\CaEntity;
use App\Form\CaEntityType;
use App\Repository\CaEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/caentity")
 */
class CaEntityController extends AbstractController
{
    /**
     * @Route("/", name="ca_entity_index", methods={"GET"})
     */
    public function index(CaEntityRepository $caEntityRepository): Response
    {
        return $this->render('ca_entity/index.html.twig', [
            'ca_entities' => $caEntityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ca_entity_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $caEntity = new CaEntity();
        $form = $this->createForm(CaEntityType::class, $caEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($caEntity);
            $entityManager->flush();

            return $this->redirectToRoute('ca_entity_index');
        }

        return $this->render('ca_entity/new.html.twig', [
            'ca_entity' => $caEntity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ca_entity_show", methods={"GET"})
     */
    public function show(CaEntity $caEntity): Response
    {
        return $this->render('ca_entity/show.html.twig', [
            'ca_entity' => $caEntity,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ca_entity_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CaEntity $caEntity): Response
    {
        $form = $this->createForm(CaEntityType::class, $caEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ca_entity_index');
        }

        return $this->render('ca_entity/edit.html.twig', [
            'ca_entity' => $caEntity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ca_entity_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CaEntity $caEntity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caEntity->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($caEntity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ca_entity_index');
    }
}
