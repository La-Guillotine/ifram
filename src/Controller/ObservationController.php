<?php

namespace App\Controller;

use App\Entity\Observation;
use App\Form\ObservationType;
use App\Repository\ObservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
/**
 * @Route("/observation")
 * @Security("is_granted('ROLE_OBSERVATEUR')")
 */
class ObservationController extends AbstractController
{
    /**
     * @Route("/", name="observation_index", methods={"GET"})
     */
    public function index(ObservationRepository $observationRepository): Response
    {
        return $this->render('observation/index.html.twig', [
            'observations' => $observationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="observation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $observation = new Observation();
        $form = $this->createForm(ObservationType::class, $observation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($observation);
            $entityManager->flush();

            return $this->redirectToRoute('observation_index');
        }

        return $this->render('observation/new.html.twig', [
            'observation' => $observation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="observation_show", methods={"GET"})
     */
    public function show(Observation $observation): Response
    {
        return $this->render('observation/show.html.twig', [
            'observation' => $observation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="observation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Observation $observation): Response
    {
        $form = $this->createForm(ObservationType::class, $observation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('observation_index');
        }

        return $this->render('observation/edit.html.twig', [
            'observation' => $observation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="observation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Observation $observation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$observation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($observation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('observation_index');
    }
}
