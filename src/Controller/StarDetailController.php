<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericDetailController;
use App\Generic\GenericSetDataInterFace;
use App\Entity\Stars;

class StarDetailController  extends GenericDetailController implements GenericSetDataInterFace
{
    private $per_page=20;
    public function setData(): void
    {
        $this->setEntity(Stars::class);
        $this->setTwig('show/stars/detail.html.twig');
    }
    
    protected function onSetAttribut() :array
    {
        return  [
            'Collector' => $this->returnUrlArguments('collector'),
            'Movies'    => $this->getObjects()->getMovies(),
            'photos'    => array_slice($this->returnPhotos(),0,10),
        ];
    }

    private function returnPhotos(){
        $photos=[];
        $dir = $this->getObjects()->getDir();
        $dir = '../public/collectors/'.$dir.'/photos';
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                if (is_dir($dir)){
                    if ($file != '.'&& $file != '..'){
                        array_push($photos,'/collectors//'.$this->getObjects()->getDir().'/photos//'.$file);
                    }
                }
              }
              closedir($dh);
            }
        }
        return $photos;
    }
}