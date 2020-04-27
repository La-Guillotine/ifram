<?php

namespace App\Controller;

use App\Entity\Plante;
use App\Form\PlanteType;
use App\Repository\PlanteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plante")
 */
class PlanteController extends AbstractController
{
    /**
     * @Route("/", name="plante_index", methods={"GET"})
     */
    public function index(PlanteRepository $planteRepository): Response
    {
        return $this->render('plante/index.html.twig', [
            'plantes' => $planteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="plante_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $plante = new Plante();
        $form = $this->createForm(PlanteType::class, $plante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plante);
            $entityManager->flush();

            return $this->redirectToRoute('plante_index');
        }

        return $this->render('plante/new.html.twig', [
            'plante' => $plante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plante_show", methods={"GET"})
     */
    public function show(PlanteRepository $planteRepository, Plante $plante): Response
    {
        return $this->render('plante/show.html.twig', [
            'plante' => $plante,
            'plantes' => $planteRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="plante_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Plante $plante): Response
    {
        $form = $this->createForm(PlanteType::class, $plante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plante_index');
        }

        return $this->render('plante/edit.html.twig', [
            'plante' => $plante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plante_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Plante $plante): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plante_index');
    }
}
