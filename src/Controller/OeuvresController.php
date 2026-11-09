<?php

namespace App\Controller;

use App\Entity\Oeuvres;
use App\Form\OeuvreType;
use App\Repository\OeuvresRepository;
use App\Repository\PhotosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OeuvresController extends AbstractController
{
    #[Route('/oeuvres', name: 'app_oeuvres')]
    public function index(OeuvresRepository $oeuvresRepository): Response
    {
        return $this->render('oeuvres/index.html.twig', [
            'oeuvres' => $oeuvresRepository->findAll(),
        ]);
    }

    #[Route('/oeuvres/nouvelle', name: 'app_oeuvres_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $oeuvre = new Oeuvres();
        $oeuvre->setDateCreation(new \DateTime());
        $oeuvre->setEstDetruite(false);

        $form = $this->createForm(OeuvreType::class, $oeuvre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($oeuvre);
            $entityManager->flush();

            return $this->redirectToRoute('app_oeuvres_show', ['id' => $oeuvre->getId()]);
        }

        return $this->render('oeuvres/new.html.twig', ['form' => $form]);
    }

    #[Route('/oeuvres/{id}', name: 'app_oeuvres_show', requirements: ['id' => '\d+'])]
    public function show(Oeuvres $oeuvre, PhotosRepository $photosRepository): Response
    {
        return $this->render('oeuvres/show.html.twig', [
            'oeuvre' => $oeuvre,
            'photos' => $photosRepository->findBy(['oeuvre' => $oeuvre], ['date_prise_vue' => 'ASC']),
        ]);
    }

    #[Route('/oeuvres/{id}/detruite', name: 'app_oeuvres_detruite', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function marquerDetruite(Oeuvres $oeuvre, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('detruite' . $oeuvre->getId(), $request->getPayload()->getString('_token'))) {
            $oeuvre->setEstDetruite(true);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_oeuvres_show', ['id' => $oeuvre->getId()]);
    }
}