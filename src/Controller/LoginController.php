<?php
// src/Controller/LoginController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login-check-non-protected', name: 'app_login_check_non_protected', methods: ['POST'])]
    public function loginCheck(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $login = $data['login'] ?? '';
        $password = $data['password'] ?? '';
        
        // Dane na sztywno
        if ($login === 'admin' && $password === 'secret123') {
            return new JsonResponse([
                'message' => 'Login successful',
                'token' => 'fake-jwt-token'
            ]);
        }

        return new JsonResponse([
            'error' => 'Invalid credentials'
        ], 401);
    }
}
