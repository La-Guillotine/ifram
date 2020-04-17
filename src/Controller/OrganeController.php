<?php

namespace App\Controller;

use App\Entity\Organe;
use App\Form\OrganeType;
use App\Repository\OrganeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/organe")
 */
class OrganeController extends AbstractController
{
    /**
     * @Route("/", name="organe_index", methods={"GET"})
     */
    public function index(OrganeRepository $organeRepository): Response
    {
        return $this->render('organe/index.html.twig', [
            'organes' => $organeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="organe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $organe = new Organe();
        $form = $this->createForm(OrganeType::class, $organe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($organe);
            $entityManager->flush();

            return $this->redirectToRoute('organe_index');
        }

        return $this->render('organe/new.html.twig', [
            'organe' => $organe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="organe_show", methods={"GET"})
     */
    public function show(Organe $organe): Response
    {
        return $this->render('organe/show.html.twig', [
            'organe' => $organe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="organe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Organe $organe): Response
    {
        $form = $this->createForm(OrganeType::class, $organe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('organe_index');
        }

        return $this->render('organe/edit.html.twig', [
            'organe' => $organe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="organe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Organe $organe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$organe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($organe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('organe_index');
    }
}
