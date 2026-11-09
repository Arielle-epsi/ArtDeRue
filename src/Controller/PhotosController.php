<?php

namespace App\Controller;

use App\Entity\Photos;
use App\Form\PhotoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PhotosController extends AbstractController
{
    #[Route('/photos/nouvelle', name: 'app_photos_new')]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        #[Autowire('%photos_directory%')] string $photosDirectory,
    ): Response {
        $photo = new Photos();
        $photo->setDatePriseVue(new \DateTime());

        $form = $this->createForm(PhotoType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fichier = $form->get('photo')->getData();
            $nouveauNom = uniqid('photo_', true) . '.' . $fichier->guessExtension();
            $fichier->move($photosDirectory, $nouveauNom);

            $photo->setNomFichier($nouveauNom);

            $entityManager->persist($photo);
            $entityManager->flush();

            return $this->redirectToRoute('app_oeuvres_show', [
                'id' => $photo->getOeuvre()->getId(),
            ]);
        }

        return $this->render('photos/new.html.twig', [
            'form' => $form,
        ]);
    }
}