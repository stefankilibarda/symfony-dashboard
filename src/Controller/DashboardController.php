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

#[Route('universal_academy', name: 'dashboard_')]
// #[IsGranted('IS_AUTHENTICATED_FULLY')]

class DashboardController extends AbstractController
{
    #[Route('/admin', name: 'index')]
    // #[IsGranted('ROLE_ADMIN')]
    public function index(UserRepository $userRepository): Response
    {
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // $this->denyAccessUnlessGranted('ROLE_ADMIN', "Role error", 'You must be a moderator');

        $users = $userRepository->findAll();
        // dd($users);

        //!is authenticated fully -> logout

        if(!$this->isGranted('ROLE_ADMIN'))
            return $this->redirectToRoute('dashboard_developer');

        return $this->render('dashboard/index.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/developer', name: 'developer')]
    public function developers_profile(UserRepository $userRepository)
    {

        return $this->render('developer/developer_profile.html.twig');
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

    #[Route('/admin/edit-developer/{id}', name: 'edit_developer')]
    public function edit_developer($id, Request $request, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);

        $form = $this->createForm(DeveloperType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $userRepository->add($user);
            return $this->redirectToRoute('dashboard_index');
        }
        
        return $this->render('dashboard/edit_developer.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/admin/view/{id}', name: 'view')]
    public function view_developer($id, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);

        return $this->render('dashboard/my_profile.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/admin/delete/{id}', name: 'delete')]
    public function delete_developer($id, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);

        $userRepository->remove($user);

        return $this->redirectToRoute('dashboard_index');
    }

    
}
