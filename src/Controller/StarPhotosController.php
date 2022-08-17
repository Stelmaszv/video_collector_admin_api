<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Generic\GenericListController;
use App\Generic\GenericSetDataInterFace;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Stars;

class StarPhotosController extends GenericListController implements GenericSetDataInterFace
{
    protected bool $paginate = TRUE;
    protected int $per_page = 20;
    private Stars $stars;
    public function setData(): void
    {
        $this->setEntity(Stars::class);
        $this->setTwig('show/stars/starphoto.twig');
    }

    protected function onSetAttribut() :array
    {
        return  [
            'ObjectData' => $this->stars,
            'Collector' => $this->returnUrlArguments('collector')
        ];
    }

    public function onQuerySet(ServiceEntityRepository $entityManager)
    {
        $this->stars = $entityManager->find($this->returnUrlArguments('id'));
        return $this->genereteGalery();
    }

    protected function genereteGalery(){
        $photos = [];
        $movies = $this->stars->getMovies();
        foreach($movies as $movie){
            $dir = '../public/collectors/'.$movie->getDir();
            if (is_dir($dir)){
                if ($dh = opendir($dir)){
                  while (($file = readdir($dh)) !== false){
                    if (is_dir($dir)){
                        if ($file != '.'&& $file != '..' && $file != 'config.JSON' && $file != 'config.json'){
                            array_push($photos,'/collectors//'.$movie->getDir().'/'.$file);
                        }
                    }
                  }
                  closedir($dh);
                }
            }
        }
        return $photos;
    }
}