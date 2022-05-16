<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('universal_academy', name: 'client_')]
class ClientController extends AbstractController
{
    #[Route('/admin/clients', name: 'clients')]
    public function show_clients(ClientRepository $clientRepository)
    {
        $clients = $clientRepository->findAll();
        // dd($clients);

        return $this->render('clients/clients_index.html.twig', [
            'clients' => $clients
        ]);
    }

    #[Route('/admin/add-client', name: 'add_client')]
    public function add_developer(Request $request, ClientRepository $clientRepository)
    {
        $clients = $clientRepository->findAll();
        $client = new Client();

        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();
            $clientRepository->add($client);
            return $this->redirectToRoute('client_clients');
        }
        
        return $this->render('clients/add_client.html.twig', [
            'form' => $form->createView(),
            'clients' => $clients
        ]);

    }

    #[Route('/admin/edit-client/{id}', name: 'edit_client')]
    public function edit_client($id, Request $request, clientRepository $clientRepository)
    {
        $client = $clientRepository->find($id);

        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();
            $clientRepository->add($client);
            return $this->redirectToRoute('client_clients');
        }
        
        return $this->render('clients/edit_client.html.twig', [
            'form' => $form->createView(),
            'client' => $client
    ]);
    }

    #[Route('/admin/view_client/{id}', name: 'view')]
    public function view_client($id, ClientRepository $clientRepository)
    {
        $client = $clientRepository->find($id);
        $tasks = $client->getUserClients();


        return $this->render('clients/clients_profile.html.twig', [
            'client' => $client,
            'tasks' => $tasks

        ]);
    }

    #[Route('/admin/delete_client/{id}', name: 'delete')]
    public function delete_client($id, ClientRepository $clientRepository)
    {
        $client = $clientRepository->find($id);

        $clientRepository->remove($client);

        return $this->redirectToRoute('client_clients');
    }
}
