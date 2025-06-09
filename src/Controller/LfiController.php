<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LfiController 
{   
    #[Route('/lfi', name: 'lfi', methods: ['GET'])]
    public function index()
    {
        $file = $_GET['file'] ?? null;

        if (!$file) {
            return new Response('No file specified', 400);
        }
        $baseDir = __DIR__ . '/files/';
        $filePath = $baseDir . $file;


        if (file_exists($filePath) && is_file($filePath)) {
            return new Response(file_get_contents($filePath));
        }
        return new Response('File not found or invalid'.$filePath, 404);
    }
}
