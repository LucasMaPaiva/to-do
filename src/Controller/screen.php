<?php

namespace App\Controller;

use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function criar(Task $task, TaskRepository $taskRepository): Response
    {

        $entities = $taskRepository->findAll();


        $pageTitle = 'Criar lista';
        return $this->render('home2.html.twig', [
            'pageTitle' => $pageTitle,
            'task'=>$task,
            'entities' => $entities
        ]);


    }

    #[Route('/criar-lista/editar')]
    public function criarEdit(Request $request,Task $task, TaskRepository $taskRepository): Response
    {
        $entities = $taskRepository->findAll();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $taskRepository->save($task, true);
            return $this->redirectToRoute('app_screen_criar');
        }
        $pageTitle = 'Editar lista';
        return $this->render('todo_list_dashboard/index.html.twig', [
            'pageTitle' => $pageTitle,
            'task'=>$task,
            'form'=>$form,
            'entities'=>$entities
        ]);


    }

    #[Route('/criar-lista/novo')]
    public function criarNovo(Request $request, TaskRepository $taskRepository, Task $task): Response
    {
        $entities = $taskRepository->findAll();
        $new = new Task();
        $form = $this->createForm(TaskType::class, $new);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $taskRepository->save($task, true);
            return $this->redirectToRoute('app_screen_criar');
        }

        $pageTitle = 'Nova lista';
        return $this->render('todo_list_dashboard/indexNew.html.twig', [
            'pageTitle' => $pageTitle,
            'form'=>$form,
        ]);


    }

    private function getDoctrine()
    {
    }
}