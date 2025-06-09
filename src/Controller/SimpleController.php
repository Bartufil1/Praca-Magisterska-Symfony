<?php

// src/Controller/TestController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SimpleController
{
    #[Route('/test')]
    public function index(): Response
    {
        return new Response('Test');
    }
}
