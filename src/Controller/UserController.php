<?php
// src/Controller/UserController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/user/profile/{id}', name: 'user_profile')]
    public function profile($id): Response
    {
        // Dane użytkowników przechowywane w tablicy
        $users = [
            123 => ['name' => 'Jan Kowalski', 'email' => 'janek@example.com'],
            2 => ['name' => 'Jane Smith', 'email' => 'jane.smith@example.com'],
            3 => ['name' => 'Alice Brown', 'email' => 'alice.brown@example.com'],
        ];

        // Sprawdzamy, czy użytkownik o podanym ID istnieje
        if (isset($users[$id])) {
            return $this->render('user/profile.html.twig', [
                'user' => $users[$id], // Przekazujemy dane użytkownika do widoku
            ]);
        }

        // Jeśli użytkownik o podanym ID nie istnieje, zwrócimy błąd
        return new Response('User not found', 404);
    }
}



