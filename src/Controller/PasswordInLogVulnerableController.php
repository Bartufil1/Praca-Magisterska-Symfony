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
                var_dump($logFile);
                file_put_contents($logFile, "[$level] $message (🔴 VULNERABLE) " . json_encode($context) . PHP_EOL, FILE_APPEND);
            }
        };
    }

    public function login(Request $request): Response
    {
        $data = $request->request->all();

        $this->logger->info('Login attempt', ['data' => $data]);

        return new Response('Login attempt logged to insecure.log.');
    }
}
