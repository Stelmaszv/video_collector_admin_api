<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericDetailController;
use App\Generic\GenericSetDataInterFace;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Producent;

class ProducentsDetailController  extends GenericDetailController implements GenericSetDataInterFace
{
    private $per_page=20;
    public function setData(): void
    {
        $this->setEntity(Producent::class);
        $this->setTwig('show/producent/detail.twig');
    }

    protected function onSetAttribut() :array
    {
        return  [
            'Collector' => $this->returnUrlArguments('collector'),
            'Movies'    => $this->returnMovies($this->paginator),
            'Series'    => $this->returnSeries($this->paginator)
        ];
    }

    private function returnMovies($paginator){
        return $paginator->paginate(
            $this->getObjects()->getMovies(),
            $this->request->query->getInt('page', 1),
            $this->per_page
        );
    }

    private function returnSeries($paginator){
        return $paginator->paginate(
            $this->getObjects()->getSeries(),
            $this->request->query->getInt('page', 1),
            $this->per_page
        );
    }

}