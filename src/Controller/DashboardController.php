<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\DeveloperType;
use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('4df319b75e352ec2c7c3d2a02cffd9f9', name: 'dashboard_')]
// #[IsGranted('IS_AUTHENTICATED_FULLY')]

class DashboardController extends AbstractController
{
    #[Route('/', name: 'index')]
    // #[IsGranted('ROLE_ADMIN')]
    public function index(UserRepository $userRepository): Response
    {
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // $this->denyAccessUnlessGranted('ROLE_ADMIN', "Role error", 'You must be a moderator');

        $users = $userRepository->findAll();
        // dd($users);

        //!is authenticated fully -> logout

        if(!$this->isGranted('ROLE_ADMIN'))
            return $this->redirectToRoute('dashboard_logout');

        return $this->render('dashboard/index.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/add-developer', name: 'add_developer')]
    public function add_developer(Request $request, UserRepository $userRepository)
    {
        $user = new User();

        $form = $this->createForm(DeveloperType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $userRepository->add($user);
            return $this->redirectToRoute('dashboard_index');
        }
        
        return $this->render('dashboard/add_developer.html.twig', ['form' => $form->createView()]);

    }

    #[Route('/view/{id}', name: 'view')]
    public function view_developer($id, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);

        return $this->render('dashboard/my_profile.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete_developer($id, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);

        $userRepository->remove($user);

        return $this->redirectToRoute('dashboard_index');
    }

    
}
