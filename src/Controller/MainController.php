<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): RedirectResponse
    {
        if ($this->getUser()){
            return $this->redirectToRoute('Setcollector');
        }
        return $this->redirectToRoute('app_login');
    }
}
