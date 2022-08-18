<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericSetDataInterFace;
use App\Generic\GenericListController;
use App\Entity\UserCollector;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SetCollectorController extends GenericListController implements GenericSetDataInterFace
{
    public function setData(): void
    {
        $this->setEntity(UserCollector::class);
        $this->setTwig('controllers/list.html.twig');
    }

}
