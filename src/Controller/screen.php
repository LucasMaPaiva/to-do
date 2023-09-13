<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;

class screen extends AbstractController
{
    #[Route('/')]
    public function telaLogin(): Response
    {

        $pageTitle = 'Entrar';
        return $this->render('login.html.twig', [
            'pageTitle' => $pageTitle,
        ]);
    }

    #[Route('/pagina-inicial')]
    public function homePage(EntityManagerInterface $entityManager): Response
    {

        $taskRepository = $entityManager->getRepository(Task::class);
        $todos = $taskRepository->findAll();

        $pageTitle = 'Lista de tarefas';
        return $this->render('home.html.twig', [
            'pageTitle' => $pageTitle,
                'todos' => $todos
        ]);
    }

    #[Route('/cadastro')]
    public function register(): Response
    {
        $pageTitle = 'Cadastro de usuário';
        return $this->render('register.html.twig', [
            'pageTitle' => $pageTitle,
        ]);
    }

    #[Route('/criar-lista')]
    public function criar(): Response
    {

        $pageTitle = 'Criar lista';
        return $this->render('create.html.twig', [
            'pageTitle' => $pageTitle,
        ]);
    }

    private function getDoctrine()
    {
    }
}