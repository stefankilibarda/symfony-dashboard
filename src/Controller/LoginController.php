<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('universal_academy', name: 'dashboard_')]
class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // if($this->getUser())
        //     return $this->redirectToRoute('dashboard_index');

        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('login/index.html.twig', [
            'error' => $error
        ]);
    }
}
