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
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Entity\Livre;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

#[IsGranted('ROLE_USER')]
final class UtilisateurController extends AbstractController
{
    #[Route('/utilisateur', name: 'app_utilisateur')]
    public function index(
        UserRepository $userRepository,
        AuteurRepository $auteurRepository,
        CategorieRepository $categorieRepository,
        LivreRepository $livreRepository,
        ReservationRepository $reservationRepository
    ): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
            'livres' => $livreRepository->findAll()
        ]);
    }

    #[Route('/utilisateur/livre/{id}', name: 'app_utilisateur_livre_show', methods: ['GET', 'POST'])]
    public function show(Request $request, Livre $livre, EntityManagerInterface $entityManager): Response
    {
        $commentaire = new Commentaire();
        $commentaire->setLivre($livre);
        $commentaire->setUtilisateur($this->getUser());
        $commentaire->setCreatedAt(new \DateTimeImmutable());
        
        $commentForm = $this->createForm(CommentaireType::class, $commentaire);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $entityManager->persist($commentaire);
            $entityManager->flush();

            $this->addFlash('success', 'Votre commentaire a été ajouté avec succès!');
            return $this->redirectToRoute('app_utilisateur_livre_show', ['id' => $livre->getId()]);
        }

        return $this->render('utilisateur/livre/show.html.twig', [
            'livre' => $livre,
            'commentForm' => $commentForm->createView(),
        ]);
    }
}