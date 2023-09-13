<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoListDashboardController extends AbstractController
{
    #[Route('/todo/list/dashboard', name: 'app_todo_list_dashboard')]
    public function index(): Response
    {
        return $this->render('todo_list_dashboard/index.html.twig', [
            'controller_name' => 'TodoListDashboardController',
        ]);
    }
}
