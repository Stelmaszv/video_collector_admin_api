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
            'Series'    => $this->returnSeries($this->paginator),
            'photos'    => array_slice($this->returnPhotos(),0,10),
            'banners'   => array_slice($this->returnBanners(),0,3),
            'TopStars'  => array_slice($this->topStars(),0,10),
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

    private function returnPhotos(){
        $photos=[];
        $dir = $this->getObjects()->getDir();
        $dir = '../public/collectors/'.$dir.'/photos';
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                if (is_dir($dir)){
                    if ($file != '.'&& $file != '..'){
                        array_push($photos,'/collectors/'.$this->getObjects()->getDir().'/photos//'.$file);
                    }
                }
              }
              closedir($dh);
            }
        }
        return $photos;
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
                        array_push($photos,'/collectors/'.$this->getObjects()->getDir().'/banners//'.$file);
                    }
                }
              }
              closedir($dh);
            }
        }
        return $photos;
    }

    private function setTopStarAvatar(string $url,string $dir,string $star_name){
        $avatar='';
        $show_dir='/'.$dir.'/stars/'.$star_name;
        if (is_dir($url)){
            if ($dh = opendir($url)){
                while (($file = readdir($dh)) !== false){
                    if ($file != '.'&& $file != '..'){
                        if ($file == 'avatar.png'){
                            echo $file;
                            $avatar=$file;
                        }
                    }
                }
            }
        }
        if (empty($avatar)){
            return '';
        }        
        return $show_dir.'/avatar.png';
    }

    private function topStars(){
        $top_stars=[];
        $dir = $this->getObjects()->getDir();
        $dir = '../public/collectors/'.$dir.'/stars';
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                if (is_dir($dir)){
                    if ($file != '.'&& $file != '..'){
                        $show_dir='/'.$this->getObjects()->getDir().'/stars';
                        $top_stars[]=array(
                            'dirname'=>$file,
                            'avatar' =>$this->setTopStarAvatar($dir.'/'.$file,$this->getObjects()->getDir(),$file)
                        );
                    }
                }
              }
              closedir($dh);
            }
        }
        return $top_stars;
    }

}