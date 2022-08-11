<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorizedController extends AbstractController
{
    #[Route('/authorized', name: 'Authorized')]
    public function index(): Response
    {
        return $this->render('authorized/index.html.twig', [
            'controller_name' => 'AuthorizedController',
        ]);
    }
}
