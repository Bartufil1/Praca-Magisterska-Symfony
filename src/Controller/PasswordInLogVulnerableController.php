<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

class PasswordInLogVulnerableController
{
    private LoggerInterface $logger;

    public function __construct()
    {
        $this->logger = new class extends AbstractLogger {
            public function log($level, \Stringable|string $message, array $context = []): void
            {
                $logFile = '/var/log/insecure.log';
                file_put_contents($logFile, "[$level] $message (🔴 VULNERABLE) " . json_encode($context) . PHP_EOL, FILE_APPEND);
            }
        };
    }

    public function login(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $username = $data['username'] ?? 'unknown';
        $password = $data['password'] ?? 'unknown';
        $this->logger->info('Login attempt', ['username' => $username, 'password' => $password]);

        return new Response('Login attempt logged to insecure.log.');
    }
}
