<?php

namespace App\Controller;

use App\Entity\Maladie;
use App\Form\MaladieType;
use App\Repository\MaladieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maladie")
 */
class MaladieController extends AbstractController
{
    /**
     * @Route("/", name="maladie_index", methods={"GET"})
     */
    public function index(MaladieRepository $maladieRepository): Response
    {
        return $this->render('maladie/index.html.twig', [
            'maladies' => $maladieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="maladie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $maladie = new Maladie();
        $form = $this->createForm(MaladieType::class, $maladie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($maladie);
            $entityManager->flush();

            return $this->redirectToRoute('maladie_index');
        }

        return $this->render('maladie/new.html.twig', [
            'maladie' => $maladie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="maladie_show", methods={"GET"})
     */
    public function show(Maladie $maladie): Response
    {
        return $this->render('maladie/show.html.twig', [
            'maladie' => $maladie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="maladie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Maladie $maladie): Response
    {
        $form = $this->createForm(MaladieType::class, $maladie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('maladie_index');
        }

        return $this->render('maladie/edit.html.twig', [
            'maladie' => $maladie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="maladie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Maladie $maladie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$maladie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($maladie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('maladie_index');
    }
}
