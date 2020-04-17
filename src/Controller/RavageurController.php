<?php

namespace App\Controller;

use App\Entity\Ravageur;
use App\Form\RavageurType;
use App\Repository\RavageurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ravageur")
 */
class RavageurController extends AbstractController
{
    /**
     * @Route("/", name="ravageur_index", methods={"GET"})
     */
    public function index(RavageurRepository $ravageurRepository): Response
    {
        return $this->render('ravageur/index.html.twig', [
            'ravageurs' => $ravageurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ravageur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ravageur = new Ravageur();
        $form = $this->createForm(RavageurType::class, $ravageur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ravageur);
            $entityManager->flush();

            return $this->redirectToRoute('ravageur_index');
        }

        return $this->render('ravageur/new.html.twig', [
            'ravageur' => $ravageur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ravageur_show", methods={"GET"})
     */
    public function show(Ravageur $ravageur): Response
    {
        return $this->render('ravageur/show.html.twig', [
            'ravageur' => $ravageur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ravageur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ravageur $ravageur): Response
    {
        $form = $this->createForm(RavageurType::class, $ravageur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ravageur_index');
        }

        return $this->render('ravageur/edit.html.twig', [
            'ravageur' => $ravageur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ravageur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ravageur $ravageur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ravageur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ravageur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ravageur_index');
    }
}
