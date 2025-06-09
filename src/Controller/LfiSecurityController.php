<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LfiSecurityController
{
    #[Route('/lfi-secure', name: 'lfi_secure', methods: ['GET'])]
    public function index()
    {
        // Pobranie ścieżki z parametru URL 'file'
        $file = $_GET['file'] ?? null;

        // Jeżeli nie ma parametru 'file', zwróć błąd
        if (!$file) {
            return new Response('No file specified', 400);
        }

        // Definicja dozwolonych plików
        $allowedFiles = ['demo.txt', 'log.txt', 'report.txt'];

        // Walidacja: Sprawdzenie, czy plik znajduje się na liście dozwolonych plików
        if (!in_array($file, $allowedFiles)) {
            return new Response('Invalid file', 403);
        }

        // Ścieżka do folderu, w którym pliki mają być wczytywane
        $baseDir = __DIR__ . '\files\\';

        // Użycie basename, aby upewnić się, że nie ma ścieżek względnych (np. `../`)
        $file = basename($file); // Usuwa wszystkie katalogi z nazwy pliku

        // Pełna ścieżka do pliku
        $filePath = realpath($baseDir . $file);

        // Sprawdzamy, czy plik znajduje się w katalogu 'files/' (zapobiega atakom typu LFI)
        if ($filePath === false || strpos($filePath, realpath($baseDir)) !== 0) {
            return new Response('Invalid file path', 403);  // Błąd 403 jeśli ścieżka jest nieprawidłowa
        }

        // Sprawdzamy, czy plik istnieje i jest plikiem
        if (file_exists($filePath) && is_file($filePath)) {
            // Zwracamy zawartość pliku
            return new Response(file_get_contents($filePath));
        }

        return new Response('File not found or invalid', 404);  // Błąd 404 jeśli plik nie istnieje
    }
}
