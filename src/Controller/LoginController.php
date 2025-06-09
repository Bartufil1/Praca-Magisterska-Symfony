<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController 
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[Route('/', name: 'login', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $error = null;
        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $password = $request->request->get('password');

            // Symulacja przechwycenia danych — zapis do loga
            $this->logger->info("Przechwycone dane logowania", [
                'username' => $username,
                'password' => $password,
            ]);

            if ($username === 'Admin' && $password === 'Mitm123') {
                return new Response('Logowanie powiodło się!');
            }
            $error = 'Niepoprawne dane logowania!';
        }

        return $this->render('login/index.html.twig', [
            'error' => $error,
        ]);
    }
}
