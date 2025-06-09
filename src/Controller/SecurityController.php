<?php
// src/Controller/SecurityController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    
    #[Route("/logout", name:"app_logout", methods: ["POST"])]
    public function logout(Request $request): Response
    {
        $this->addFlash('info', 'Wylogowano!');
        return new Response('Wylogowano pomyślnie.');
    }

    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $username = $request->request->get('_username');
            $password = $request->request->get('_password');

            if ($username === 'user' && $password === 'pass') {
                $this->addFlash('success', 'Zalogowano!');
                return $this->redirectToRoute('homepage');
            }

            $this->addFlash('error', 'Błędne dane!');
        }

        return $this->render('security/login.html.twig');
    }
}

