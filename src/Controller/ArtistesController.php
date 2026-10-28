<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArtistesController extends AbstractController
{
    #[Route('/artistes', name: 'app_artistes')]
    public function index(): Response
    {
        return $this->render('artistes/index.html.twig', [
            'controller_name' => 'ArtistesController',
        ]);
    }
}
