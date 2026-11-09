<?php

namespace App\Controller;

use App\Repository\LieuxRepository;
use App\Repository\OeuvresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LieuxController extends AbstractController
{
    #[Route('/lieux', name: 'app_lieux')]
    public function index(LieuxRepository $lieuxRepository, OeuvresRepository $oeuvresRepository): Response
    {
        $lieux = $lieuxRepository->findAll();

        $oeuvresParLieu = [];
        foreach ($lieux as $lieu) {
            $oeuvresParLieu[$lieu->getId()] = $oeuvresRepository->findBy(['lieu' => $lieu]);
        }

        return $this->render('lieux/index.html.twig', [
            'lieux' => $lieux,
            'oeuvresParLieu' => $oeuvresParLieu,
        ]);
    }
}