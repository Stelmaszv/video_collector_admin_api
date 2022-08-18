<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericSetDataInterFace;
use App\Generic\GenericListController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Stars;


class StarMoviesController extends GenericListController implements GenericSetDataInterFace
{
    protected bool $paginate = TRUE;
    protected int $per_page = 20;
    private Stars $star;
    public function setData(): void
    {
        $this->setEntity(Stars::class);
        $this->setTwig('show/stars/movislist.html.twig');
    }

    public function onQuerySet(ServiceEntityRepository $entityManager)
    {
        $this->star=  $entityManager->find($this->returnUrlArguments('id'));
        return $this->star->getMovies();
    }

    protected function onSetAttribut() :array
    {
        return  [
            'Star'      => $this->star,
            'Collector' => $this->returnUrlArguments('collector')
        ];
    }
}