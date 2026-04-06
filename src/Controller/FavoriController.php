<?php

namespace App\Controller;

use App\Entity\Livre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Entity\Favori;
use App\Form\FavoriType;
use App\Repository\FavoriRepository;
use Doctrine\ORM\EntityManagerInterface;

#[IsGranted('ROLE_USER')]
#[Route('/favori')]
final class FavoriController extends AbstractController
{
    #[Route(name: 'app_favori_index', methods: ['GET'])]
    public function index(FavoriRepository $favoriRepository): Response
    {
        return $this->render('utilisateur/favori/index.html.twig', [
            'favoris' => $favoriRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_favori_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $favori = new Favori();
        $form = $this->createForm(FavoriType::class, $favori);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($favori);
            $entityManager->flush();

            return $this->redirectToRoute('app_favori_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('utilisateur/favori/new.html.twig', [
            'favori' => $favori,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_favori_show', methods: ['GET'])]
    public function show(Favori $favori): Response
    {
        return $this->render('utilisateur/favori/show.html.twig', [
            'favori' => $favori,
        ]);
    }

    #[Route('/{id}', name: 'app_favori_delete', methods: ['POST'])]
    public function delete(Request $request, Favori $favori, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$favori->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($favori);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_favori_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/livre/{id}/toggle', name: 'app_favori_toggle', methods: ['POST'])]
    public function toggle(Request $request, Livre $livre, EntityManagerInterface $entityManager, FavoriRepository $favoriRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        if (!$this->isCsrfTokenValid('toggle_favorite', $request->request->get('_token'))) {
            throw new \Exception('Token CSRF invalide');
        }

        $existingFavori = $favoriRepository->findOneBy([
            'livre' => $livre,
            'user_favoris' => $user
        ]);

        if ($existingFavori) {
            $entityManager->remove($existingFavori);
            $this->addFlash('success', 'Livre retiré des favoris!');
        } else {
            $favori = new Favori();
            $favori->setLivre($livre);
            $favori->setUserFavoris($user);
            $entityManager->persist($favori);
            $this->addFlash('success', 'Livre ajouté aux favoris!');
        }

        $entityManager->flush();
        return $this->redirectToRoute('app_utilisateur_livre_show', ['id' => $livre->getId()]);
    }
}
