<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeriesListController extends AbstractController
{
    #[Route('/series/list', name: 'app_series_list')]
    public function listView(): Response
    {
        return $this->render('series_list/index.html.twig', [
            'controller_name' => 'SeriesListController',
        ]);
    }
}
