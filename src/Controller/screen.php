<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class screen extends AbstractController
{
    // TODO - adicionar a função de login
    #[Route('/')]
    public function telaLogin(): Response
    {
        return $this->render('login.html.twig');
    }
}