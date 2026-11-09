<?php

namespace App\Controller;

use App\Repository\ArtistesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Artistes;
use App\Repository\OeuvresRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArtistesController extends AbstractController
{
    #[Route('/artistes', name: 'app_artistes')]
    public function index(ArtistesRepository $artistesRepository): Response
    {
        return $this->render('artistes/index.html.twig', [
            'artistes' => $artistesRepository->findAll(),
        ]);
    }

    #[Route('/artistes/{id}', name: 'app_artistes_show', requirements: ['id' => '\d+'])]
public function show(Artistes $artiste, OeuvresRepository $oeuvresRepository): Response
{
    return $this->render('artistes/show.html.twig', [
        'artiste' => $artiste,
        'oeuvres' => $oeuvresRepository->findByArtiste($artiste),
    ]);
}

#[Route('/artistes/{id}/supprimer', name: 'app_artistes_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
public function delete(Artistes $artiste, Request $request, EntityManagerInterface $entityManager): Response
{
    if (!$this->isCsrfTokenValid('supprimer_artiste' . $artiste->getId(), $request->getPayload()->getString('_token'))) {
        return $this->redirectToRoute('app_artistes');
    }

    $pseudonyme = $artiste->getPseudonyme();

    try {
        $entityManager->remove($artiste);
        $entityManager->flush();
        $this->addFlash('success', "L'artiste « $pseudonyme » a été supprimé.");
    } catch (ForeignKeyConstraintViolationException) {
        $this->addFlash('error', "Impossible de supprimer « $pseudonyme » : des œuvres sont rattachées à cet artiste.");

        return $this->redirectToRoute('app_artistes_show', ['id' => $artiste->getId()]);
    }

    return $this->redirectToRoute('app_artistes');
}
}