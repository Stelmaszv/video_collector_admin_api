<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericDetailController;
use App\Generic\GenericSetDataInterFace;
use App\Entity\Series;

class SeriessPhotosController  extends GenericDetailController implements GenericSetDataInterFace
{
    public function setData(): void
    {
        $this->setEntity(Series::class);
        $this->setTwig('show/series/photos.twig');
    }

    protected function onSetAttribut() :array
    {
        return  [
            'Collector' => $this->returnUrlArguments('collector'),
            'photos'    => array_slice($this->genereteGalery(),0,100)
        ];
    }

    protected function genereteGalery(){
        $photos = [];
        $movies = $this->getObjects()->getMovies();
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