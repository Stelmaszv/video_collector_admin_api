<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericSetDataInterFace;
use App\Generic\GenericListController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Series;

class SeriesMoviesController extends GenericListController implements GenericSetDataInterFace
{
    protected bool $paginate = TRUE;
    protected int $per_page = 20;
    private Series $series;
    public function setData(): void
    {
            $this->setEntity(Series::class);
            $this->setTwig('show/series/movislist.html.twig');
    }

    public function onQuerySet(ServiceEntityRepository $entityManager)
    {
        $this->series=  $entityManager->find($this->returnUrlArguments('id'));
        return $this->series->getMovies();
    }

    protected function onSetAttribut() :array
    {
        return  [
            'ObjectData' => $this->series,
            'Collector'  => $this->returnUrlArguments('collector')
        ];
    }

}