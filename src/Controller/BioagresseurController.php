<?php

namespace App\Controller;

use App\Entity\Bioagresseur;
use App\Form\BioagresseurType;
use App\Repository\BioagresseurRepository;
use App\Repository\MaladieRepository;
use App\Repository\RavageurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bioagresseur")
 */
class BioagresseurController extends AbstractController
{
    /**
     * @Route("/", name="bioagresseur_index", methods={"GET"})
     */
    public function index(
        BioagresseurRepository $bioagresseurRepository,
        MaladieRepository $maladieRepository,
        RavageurRepository $ravageurRepository): Response
    {
        return $this->render('bioagresseur/index.html.twig', [
            'bioagresseurs' => $bioagresseurRepository->findAll(),
            'maladies' => $maladieRepository->findAll(),
            'ravageurs' => $ravageurRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="bioagresseur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bioagresseur = new Bioagresseur();
        $form = $this->createForm(BioagresseurType::class, $bioagresseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bioagresseur);
            $entityManager->flush();

            return $this->redirectToRoute('bioagresseur_index');
        }

        return $this->render('bioagresseur/new.html.twig', [
            'bioagresseur' => $bioagresseur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bioagresseur_show", methods={"GET"})
     */
    public function show(Bioagresseur $bioagresseur): Response
    {
        return $this->render('bioagresseur/show.html.twig', [
            'bioagresseur' => $bioagresseur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bioagresseur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bioagresseur $bioagresseur): Response
    {
        $form = $this->createForm(BioagresseurType::class, $bioagresseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bioagresseur_index');
        }

        return $this->render('bioagresseur/edit.html.twig', [
            'bioagresseur' => $bioagresseur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bioagresseur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bioagresseur $bioagresseur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bioagresseur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bioagresseur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bioagresseur_index');
    }
}
