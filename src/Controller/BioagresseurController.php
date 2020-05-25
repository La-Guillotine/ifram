<?php

namespace App\Controller;

use App\Entity\Bioagresseur;
use App\Entity\Maladie;
use App\Entity\Ravageur;
use App\Form\BioagresseurType;
use App\Form\MaladieType;
use App\Form\RavageurType;
use App\Repository\BioagresseurRepository;
use App\Repository\MaladieRepository;
use App\Repository\RavageurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
     * @Route("/newMaladie", name="bioagresseur_new_maladie", methods={"GET","POST"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function newMaladie(Request $request): Response
    {
        $maladie = new Maladie();
        $form = $this->createForm(MaladieType::class, $maladie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
           //var_dump($maladie->getOrganes());
            $entityManager->persist($maladie);
            $entityManager->flush();

            return $this->redirectToRoute('bioagresseur_index');
        }

        return $this->render('bioagresseur/new_maladie.html.twig', [
            'maladie' => $maladie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newRavageur", name="bioagresseur_new_ravageur", methods={"GET","POST"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function newRavageur(Request $request): Response
    {
        $ravageur = new Ravageur();
        $form = $this->createForm(RavageurType::class, $ravageur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ravageur);
            $entityManager->flush();

            return $this->redirectToRoute('bioagresseur_index');
        }

        return $this->render('bioagresseur/new_ravageur.html.twig', [
            'ravageur' => $ravageur,
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
     * @Security("is_granted('ROLE_USER')")
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
     * @Security("is_granted('ROLE_USER')")
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
