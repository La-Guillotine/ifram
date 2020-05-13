<?php

namespace App\Controller;

use App\Entity\Bioagresseur;
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
     * @Route("/new", name="bioagresseur_new", methods={"GET","POST"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function new(Request $request): Response
    {
        $forms = [];
        $views = [];
        $types = [
            'maladie' => MaladieType::class,
            'ravageur' => RavageurType::class
        ];
        // create the forms based on the types indicated in the types array
        foreach($types as $type){
            $forms[] = $this->createForm($type);
        }
        
        if ($request->isMethod('POST')) {
            foreach ($forms as $form) {
                $form->handleRequest($request);

                if (!$form->isSubmitted()) continue; // no need to validate a form that isn't submitted

                if ($form->isSubmitted() && $form->isValid()) {
                    $objet = $form->getData();
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($objet);
                    $entityManager->flush();
        
                    return $this->redirectToRoute('bioagresseur_index');
                } 
            }
        }

        
        foreach ($forms as $form) {
            $views[] = $form->createView();
        }
        return $this->render('bioagresseur/new.html.twig', [
            'forms' => $views,
            'types' => $types
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
