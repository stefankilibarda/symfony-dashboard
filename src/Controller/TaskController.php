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
    public function add_task($id, UserRepository $userRepository, ClientRepository $clientRepository, UserClientRepository $userClientRepository, Request $request): Response
    {
        $user = $userRepository->find($id);
        $clients = $clientRepository->findAll();

        $task = new UserClient();
        // $form = $this->createForm(TaskType::class, $task);

        // $form->handleRequest($request);
        
        
        // if ($form->isSubmitted() && $form->isValid()) {
        //     $task->setUser($user);
        //     $taskDescription->setTaskDescription();
        //     $userClientRepository->add($task);
        //     return $this->redirectToRoute('dashboard_index');
        // }
        
        if(isset($_POST['add_task_btn'])){
            $client = $clientRepository->find($request->request->get('select_client'));

            $task->setUser($user);
            $task->setClient($client);
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
    
    #[Route('/edit-task/{id}', name: 'edit_task')]
    public function edit_task($id,  UserRepository $userRepository, ClientRepository $clientRepository, UserClientRepository $userClientRepository, Request $request)
    {
        $task = $userClientRepository->find(['id' => $id]);
        
        if(isset($_POST['edit_task_btn'])){
            $task = $userClientRepository->find($request->request->get('select_client'));
            // dd ($task);

            // $task->user->getFirstName($user);
            // $task->setClient($client);
            $task->setTaskDescription($request->request->get('task_description'));
            // dd($task->setTaskDescription($request->request->get('task_description')));
            $userClientRepository->add($task);
            return $this->redirectToRoute('dashboard_index');
        }

        return $this->render('task/edit_task.html.twig', [
            'tasks' => $userClientRepository->findAll(),
            // 'form' => $form->createView()
        ]);
    }

    #[Route('delete-task/{id}', name: 'delete_task')]
    public function delete_task($id, UserClientRepository $userClientRepository)
    {
        $task = $userClientRepository->find(['id' => $id]);
        // dd($task);

        $userClientRepository->remove($task);

        return $this->redirectToRoute('dashboard_index');


    }
}
