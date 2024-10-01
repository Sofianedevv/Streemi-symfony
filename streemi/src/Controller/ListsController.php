<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListsController extends AbstractController
{
    #[Route('/lists', name: 'app_lists')]
    public function index(): Response
    {
        return $this->render('lists.html.twig', [
            'controller_name' => 'ListsController',
        ]);
    }
}
