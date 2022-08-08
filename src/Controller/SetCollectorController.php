<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SetCollectorController extends AbstractController
{
    #[Route('/setcollector', name: 'app_set_collector')]
    public function index(): Response
    {
        return $this->render('set_collector/index.html.twig', [
            'controller_name' => 'SetCollectorController',
        ]);
    }
}
