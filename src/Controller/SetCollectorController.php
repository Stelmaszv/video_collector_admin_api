<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericSetDataInterFace;
use App\Generic\GenericListController;
use App\Entity\Collectors;

class SetCollectorController extends GenericListController implements GenericSetDataInterFace
{
    public function setData(): void
    {
        $this->setEntity(Collectors::class);
        $this->setTwig('controllers/list.html.twig');
    }
}
