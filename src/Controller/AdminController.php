<?php

namespace App\Controller;

use App\Repository\AuteurRepository;
use App\Repository\CategorieRepository;
use App\Repository\LivreRepository;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(
        UserRepository $userRepository,
        AuteurRepository $auteurRepository,
        CategorieRepository $categorieRepository,
        LivreRepository $livreRepository,
        ReservationRepository $reservationRepository
    ): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'userCount' => $userRepository->count([]),
            'auteurCount' => $auteurRepository->count([]),
            'categorieCount' => $categorieRepository->count([]),
            'livreCount' => $livreRepository->count([]),
            'reservationCount' => $reservationRepository->count([]),
        ]);
    }
}