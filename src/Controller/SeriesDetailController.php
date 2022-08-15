<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericDetailController;
use App\Generic\GenericSetDataInterFace;
use App\Entity\Series;

class SeriesDetailController  extends GenericDetailController implements GenericSetDataInterFace
{
    public function setData(): void
    {
        $this->setEntity(Series::class);
        $this->setTwig('show/series/detail.twig');
    }

    protected function onSetAttribut() :array
    {
        return  [
            'Collector' => $this->returnUrlArguments('collector')
        ];
    }

}
