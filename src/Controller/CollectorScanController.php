<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollectorScanController extends AbstractController
{
    #[Route('/collectorscan/{{controller}}/{{controllerid}}', name: 'CollectorScan')]
    public function index(string $controller): Response
    {
        return $this->render('collector_scan/index.html.twig', [
            'controller_name' => 'CollectorScanController',
        ]);
    }
}
