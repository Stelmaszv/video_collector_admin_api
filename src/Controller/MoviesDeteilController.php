<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericDetailController;
use App\Generic\GenericSetDataInterFace;
use App\Entity\Movies;

class MoviesDeteilController  extends GenericDetailController implements GenericSetDataInterFace
{
    protected bool $paginate = FALSE;
    public function setData(): void
    {
        $this->setEntity(Movies::class);
        $this->setTwig('show/movies/detail.twig');
    }

    protected function onSetAttribut() :array
    {
        return  [
            'Collector' => $this->returnUrlArguments('collector'),
            'Galery'    => $this->returnGalery()
        ];
    }

    
    private function returnGalery(){
        $photos=[];
        $dir = $this->getObjects()->getDir();
        $dir = '../public/collectors/'.$dir;
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                if (is_dir($dir)){
                    if ($file != '.'&& $file != '..' && $file != 'config.JSON'){
                        array_push($photos,'/collectors//'.$this->getObjects()->getDir().'/'.$file);
                    }
                }
              }
              closedir($dh);
            }
        }
        return $photos;
    }

}
