<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use InvalidArgumentException;


class DivisionController extends AbstractController
{
    #[Route('/divide', name: 'app_divide', methods: ['POST'])]
    public function divide(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $numerator = $data['numerator'] ?? null;
        $denominator = $data['denominator'] ?? null;

        try {
            if ($denominator == 0) {      
                throw new InvalidArgumentException("Division by zero is not allowed.");
            }
            $result = $numerator / $denominator;

            return new JsonResponse(['result' => $result], Response::HTTP_OK);

        } catch (InvalidArgumentException $e) {
            throw new \RuntimeException("An unexpected calculation error occurred!");

        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
