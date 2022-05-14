<?php

namespace App\Controller;

use App\Entity\UserClient;
use App\Form\TaskType;
use App\Repository\ClientRepository;
use App\Repository\UserClientRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('universal_academy', name: 'dashboard_')]
class TaskController extends AbstractController
{
    #[Route('/add_task/{id}', name: 'add_task')]
    public function index($id, UserRepository $userRepository, ClientRepository $clientRepository, UserClientRepository $userClientRepository, Request $request): Response
    {
        $user = $userRepository->find($id);
        $clients = $clientRepository->findAll();

        $task = new UserClient();
        // $form = $this->createForm(TaskType::class, $task);

        // $form->handleRequest($request);
        
        
        // if ($form->isSubmitted() && $form->isValid()) {
        //     dd($request);
        //     $task->setUser($user);
        //     $taskDescription->setTaskDescription();
        //     $userClientRepository->add($task);
        //     return $this->redirectToRoute('dashboard_index');
        // }

        if(isset($_POST['add_task_btn'])){
            $task->setUser($request->request->get('task_description'));
            $task->setClient($request->request->get('task_description'));
            $task->setTaskDescription($request->request->get('task_description'));
            $userClientRepository->add($task);
            return $this->redirectToRoute('dashboard_index');
        }

        return $this->render('task/add_task.html.twig', [
            'clients' => $clients,
            'user' => $user,
            'task' => $userClientRepository->findAll(),
            // 'form' => $form->createView()
        ]);
    }
}
