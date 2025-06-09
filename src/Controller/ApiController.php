<?php
// src/Controller/ApiController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\RateLimiter\RateLimiterFactory;

class ApiController extends AbstractController
{
    #[Route('/login-check-protected', name: 'app_login_check_protected', methods: ['POST'])]
    public function loginCheck(
        Request $request,
        RateLimiterFactory $anonymousApiLimiter
    ): JsonResponse {
        $limiter = $anonymousApiLimiter->create($request->getClientIp());

        if (false === $limiter->consume(1)->isAccepted()) {
            throw new TooManyRequestsHttpException();
        }

        $data = json_decode($request->getContent(), true);
        $login = $data['login'] ?? '';
        $password = $data['password'] ?? '';

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
