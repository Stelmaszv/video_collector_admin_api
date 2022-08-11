<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesListController extends AbstractController
{
    public function listView(): Response
    {
        return $this->render('movies_list/index.html.twig', [
            'controller_name' => 'MoviesListController',
        ]);
    }
}
