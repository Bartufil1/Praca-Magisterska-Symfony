<?php
// src/Controller/UserController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserControllerSecurity extends AbstractController
{
    #[Route('/userSecurity/profile/{id}', name: 'userSecurity_profile')]
    public function index($id): Response
    {
        // Przykład danych użytkowników przechowywanych w tablicy
        $users = [
            123 => ['name' => 'Jan Kowalski', 'email' => 'janek@example.com'],
            2 => ['name' => 'Jane Smith', 'email' => 'jane.smith@example.com'],
            3 => ['name' => 'Alice Brown', 'email' => 'alice.brown@example.com'],
        ];

        // Simulacja zalogowanego użytkownika
        // W rzeczywistej aplikacji id użytkownika będzie pochodzić z sesji lub z tokenu
        $loggedInUserId = 123; // Załóżmy, że użytkownik o ID 123 jest zalogowany

        // Sprawdzamy, czy użytkownik o podanym ID istnieje w tablicy
        if (isset($users[$id])) {
            // Sprawdzamy, czy zalogowany użytkownik ma dostęp do swojego profilu
            if ($id !== $loggedInUserId) {
                // Jeśli próbujesz uzyskać dostęp do profilu innego użytkownika
                return new Response('Access Denied!', 403); // Zwracamy błąd 403
            }

            // Jeśli wszystko w porządku, wyświetlamy dane użytkownika
            return new Response(
                'Name: ' . $users[$id]['name'] . '<br>Email: ' . $users[$id]['email']
            );
        }

        // Jeśli nie znaleziono użytkownika o podanym ID, zwrócimy błąd 404
        return new Response('User not found', 404);
    }
}
