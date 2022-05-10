<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('4df319b75e352ec2c7c3d2a02cffd9f9', name: 'dashboard_')]
// #[IsGranted('IS_AUTHENTICATED_FULLY')]

class DashboardController extends AbstractController
{
    #[Route('/', name: 'index')]
    // #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // $this->denyAccessUnlessGranted('ROLE_ADMIN', "Role error", 'You must be a moderator');

        if(!$this->isGranted('ROLE_ADMIN'))
            return $this->redirectToRoute('dashboard_logout');

        return $this->render('dashboard/index.html.twig');
    }
}
