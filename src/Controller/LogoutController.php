<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/4df319b75e352ec2c7c3d2a02cffd9f9', name: 'dashboard_')]
class LogoutController extends AbstractController
{
    #[Route('/logout', name: 'logout')]
    public function index()
    {
        
    }
}
