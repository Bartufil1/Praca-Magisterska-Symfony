<?php

namespace App\Controller;

use App\Services\Analytics;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BlogController extends AbstractController
{
    #[Route('/message', name: 'app_blog_post_search', methods: ['GET'])]
    public function search(Request $request): Response
    {
        $search = $request->get('s');

        return $this->render('blog/index.html.twig', [
            'search' => $search,
        ]);
    }

    #[Route('/message-secure', name: 'app_blog_post_search', methods: ['GET'])]
    public function search_secure(Request $request): Response
    {
        $search = $request->get('s');

        return $this->render('blog/index2.html.twig', [
            'search' => $search,
        ]);
    }

    #[Route('/legal', name: 'app_legal')]
    public function legal(): Response
    {
        return $this->render('blog/legal.html.twig');
    }
}
