<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericSetDataInterFace;
use App\Generic\GenericListController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Stars;
use App\Entity\Producent;

class StarInProducentMovieListController extends GenericListController implements GenericSetDataInterFace
{
    protected bool $paginate = TRUE;
    protected int $per_page = 20;
    private Producent $Producent;
    private Stars $star;

    public function setData(): void
    {
        $this->setEntity(Producent::class);
        $this->setTwig('show/stars/starMovieListInPoducent.html.twig');
    }

    protected function onSetAttribut() :array
    {
        return  [
            'Collector'   => $this->returnUrlArguments('collector'),
            'ObjectData'  => $this->Producent,
            'StarData'    => $this->star,
        ];
    }

    public function onQuerySet(ServiceEntityRepository $entityManager)
    {   

        $this->star =  $this->doctrine->getManager()->getRepository(Stars::class)->findOneBy(['name' => $this->returnUrlArguments('star')]);
        $this->Producent= $entityManager->find($this->returnUrlArguments('producentid'));
        return $this->findMovies();
    }

    private function findMovies(){
        $movies=[];
        foreach($this->Producent->getMovies() as $movie){
            foreach($movie->getStars() as $star){
                if ($star->getId() == $this->star->getId()){
                    array_push($movies,$movie);
                }
            }
        }
        return $movies;
    }
}