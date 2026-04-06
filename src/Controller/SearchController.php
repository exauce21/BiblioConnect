<?php

namespace App\Controller;

use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SearchController extends AbstractController
{
    #[Route('/utilisateur/search', name: 'app_search_livre', methods: ['GET'])]
    public function search(Request $request, LivreRepository $livreRepository): Response
    {
        $searchTerm = trim((string) $request->query->get('q', ''));
        $livres = $livreRepository->searchByTerm($searchTerm);

        return $this->render('utilisateur/index.html.twig', [
            'livres' => $livres,
            'searchTerm' => $searchTerm,
        ]);
    }
}
