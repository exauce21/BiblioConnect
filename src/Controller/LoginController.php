<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class LoginController extends AbstractController
{
    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }

    #[Route('/autre', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // If user is already authenticated, redirect based on their role
        if ($this->getUser()) {
            return $this->redirectBasedOnRole();
        }

         // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
            'lastUsername' => $lastUsername,
            'error' => $error
        ]);
    }

    #[Route('/login/success', name: 'app_login_success')]
    public function loginSuccess(): RedirectResponse
    {
        return $this->redirectBasedOnRole();
    }

    private function redirectBasedOnRole(): RedirectResponse
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $roles = $user->getRoles();

        // Role-based redirection logic
        if (in_array('ROLE_ADMIN', $roles) || in_array('ROLE_SUPER_ADMIN', $roles)) {
            // Admin users go to user management dashboard
            return $this->redirectToRoute('app_user_index');
        }

        if (in_array('ROLE_LIBRARIAN', $roles)) {
            // Librarian users go to librarian dashboard
            return $this->redirectToRoute('app_bibliothecaire');
        }

        // Default for regular users (ROLE_USER, ROLE_LECTEUR)
        return $this->redirectToRoute('app_home');
    }
}
