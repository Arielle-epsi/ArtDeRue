<?php

namespace App\Controller;

use App\Entity\Techniques;
use App\Repository\TechniquesRepository;
use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TechniquesController extends AbstractController
{
    #[Route('/techniques', name: 'app_techniques')]
    public function index(TechniquesRepository $techniquesRepository): Response
    {
        return $this->render('techniques/index.html.twig', [
            'techniques' => $techniquesRepository->findAll(),
        ]);
    }

    #[Route('/techniques/{id}/supprimer', name: 'app_techniques_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(Techniques $technique, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$this->isCsrfTokenValid('supprimer_technique' . $technique->getId(), $request->getPayload()->getString('_token'))) {
            return $this->redirectToRoute('app_techniques');
        }

        $nom = $technique->getNom();

        try {
            $entityManager->remove($technique);
            $entityManager->flush();
            $this->addFlash('success', "La technique « $nom » a été supprimée.");
        } catch (ForeignKeyConstraintViolationException) {
            $this->addFlash('error', "Impossible de supprimer « $nom » : des œuvres utilisent cette technique.");
        }

        return $this->redirectToRoute('app_techniques');
    }
}