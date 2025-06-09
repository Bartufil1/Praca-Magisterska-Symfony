<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserControllerSecurity extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[Route('/secure', name: 'secure', methods: ['GET', 'POST'], schemes: ['https'])]
    public function secure(Request $request): Response
    {
        if (!$request->isSecure()) {
            return $this->redirectToRoute('secure', [], Response::HTTP_MOVED_PERMANENTLY);
        }

        $error = null;

        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $password = $request->request->get('password');

            // Symulacja przechwycenia danych - logowanie
            $this->logger->info("Przechwycone dane logowania (secure)", [
                'username' => $username,
                'password' => $password,
            ]);

            if ($username === 'Admin' && $password === 'Mitm123') {
                return new Response('Logowanie powiodło się na bezpiecznym endpointzie!');
            }

            $error = 'Niepoprawne dane logowania!';
        }

        return $this->render('secure/index.html.twig', [
            'error' => $error,
        ]);
    }
}
