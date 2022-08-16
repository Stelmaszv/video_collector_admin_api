<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericDetailController;
use App\Generic\GenericSetDataInterFace;
use App\Entity\Series;

class SeriessBannerController extends GenericDetailController implements GenericSetDataInterFace
{
    public function setData(): void
    {
        $this->setEntity(Series::class);
        $this->setTwig('show/series/banners.twig');
    }

    protected function onSetAttribut() :array
    {
        return  [
            'Collector' => $this->returnUrlArguments('collector'),
            'baners'    => $this->returnBanners()
        ];
    }

    private function returnBanners(){
        $photos=[];
        $dir = $this->getObjects()->getDir();
        $dir = '../public/collectors/'.$dir.'/banners';
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                if (is_dir($dir)){
                    if ($file != '.'&& $file != '..'){
                        array_push($photos,'/collectors//'.$this->getObjects()->getDir().'/banners//'.$file);
                    }
                }
              }
              closedir($dh);
            }
        }
        return $photos;
    }
}

