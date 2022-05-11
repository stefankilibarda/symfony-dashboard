<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('4df319b75e352ec2c7c3d2a02cffd9f9', name: 'client_')]
class ClientController extends AbstractController
{
    #[Route('/clients', name: 'clients')]
    public function show_clients(ClientRepository $clientRepository)
    {
        $clients = $clientRepository->findAll();
        // dd($clients);

        return $this->render('clients/clients_index.html.twig', [
            'clients' => $clients
        ]);
    }

    #[Route('/view_client/{id}', name: 'view')]
    public function view_client($id, ClientRepository $clientRepository)
    {
        $client = $clientRepository->find($id);

        return $this->render('clients/clients_profile.html.twig', [
            'client' => $client
        ]);
    }

    #[Route('/delete_client/{id}', name: 'delete')]
    public function delete_client($id, ClientRepository $clientRepository)
    {
        $client = $clientRepository->find($id);

        $clientRepository->remove($client);

        return $this->redirectToRoute('client_clients');
    }
}
