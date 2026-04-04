<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BibliothecaireController extends AbstractController
{
    #[Route('/bibliothecaire', name: 'app_bibliothecaire')]
    public function index(): Response
    {
        return $this->render('bibliothecaire/index.html.twig', [
            'controller_name' => 'BibliothecaireController',
        ]);
    }
}