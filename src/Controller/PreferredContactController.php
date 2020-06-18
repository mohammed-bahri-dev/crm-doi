<?php

namespace App\Controller;

use App\Entity\PreferredContact;
use App\Form\PreferredContactType;
use App\Repository\PreferredContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/preferred_contact")
 */
class PreferredContactController extends AbstractController
{
    /**
     * @Route("/", name="preferred_contact_index", methods={"GET"})
     */
    public function index(PreferredContactRepository $preferredContactRepository): Response
    {
        return $this->render('preferred_contact/index.html.twig', [
            'preferred_contacts' => $preferredContactRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="preferred_contact_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $preferredContact = new PreferredContact();
        $form = $this->createForm(PreferredContactType::class, $preferredContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($preferredContact);
            $entityManager->flush();

            return $this->redirectToRoute('preferred_contact_index');
        }

        return $this->render('preferred_contact/new.html.twig', [
            'preferred_contact' => $preferredContact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="preferred_contact_show", methods={"GET"})
     */
    public function show(PreferredContact $preferredContact): Response
    {
        return $this->render('preferred_contact/show.html.twig', [
            'preferred_contact' => $preferredContact,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="preferred_contact_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PreferredContact $preferredContact): Response
    {
        $form = $this->createForm(PreferredContactType::class, $preferredContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('preferred_contact_index');
        }

        return $this->render('preferred_contact/edit.html.twig', [
            'preferred_contact' => $preferredContact,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="preferred_contact_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PreferredContact $preferredContact): Response
    {
        if ($this->isCsrfTokenValid('delete'.$preferredContact->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($preferredContact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('preferred_contact_index');
    }
}
