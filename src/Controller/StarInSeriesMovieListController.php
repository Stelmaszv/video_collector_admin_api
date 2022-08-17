<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericSetDataInterFace;
use App\Generic\GenericListController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Series;
use App\Entity\Stars;

class StarInSeriesMovieListController extends GenericListController implements GenericSetDataInterFace
{
    protected bool $paginate = TRUE;
    protected int $per_page = 20;
    private Series $series;
    private Stars $star;
    public function setData(): void
    {
        $this->setEntity(Series::class);
        $this->setTwig('show/stars/starMovieListInSeries.html.twig');
    }

    protected function onSetAttribut() :array
    {
        return  [
            'Collector'   => $this->returnUrlArguments('collector'),
            'ObjectData'  => $this->series,
            'StarData'    => $this->star,
        ];
    }

    public function onQuerySet(ServiceEntityRepository $entityManager)
    {   

        $this->star =  $this->doctrine->getManager()->getRepository(Stars::class)->findOneBy(['name' => $this->returnUrlArguments('star')]);
        $this->series= $entityManager->find($this->returnUrlArguments('seriesid'));
        return $this->findMovies();
    }

    private function findMovies(){
        $movies=[];
        foreach($this->series->getMovies() as $movie){
            foreach($movie->getStars() as $star){
                if ($star->getId() == $this->star->getId()){
                    array_push($movies,$movie);
                }
            }
        }
        return $movies;
    }
}


