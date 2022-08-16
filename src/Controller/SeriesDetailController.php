<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericDetailController;
use App\Generic\GenericSetDataInterFace;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Series;

class SeriesDetailController  extends GenericDetailController implements GenericSetDataInterFace
{
    private $per_page=20;
    public function setData(): void
    {
        $this->setEntity(Series::class);
        $this->setTwig('show/series/detail.twig');
    }

    protected function onSetAttribut() :array
    {
        return  [
            'Collector' => $this->returnUrlArguments('collector'),
            'Movies'    => $this->returnMovies($this->paginator),
            'TopStars'  => array_slice($this->topStars(),0,10)
        ];
    }

    private function returnMovies($paginator){
        return $paginator->paginate(
            $this->getObjects()->getMovies(),
            $this->request->query->getInt('page', 1),
            $this->per_page
        );
    }

    private function setTopStarAvatar(string $url){
        return $url.'/avatar.jpeg';
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
                        $show_dir='/collectors//'.$this->getObjects()->getDir().'/stars';
                        $top_stars[]=array(
                            'dirname'=>$file,
                            'avatar' =>$this->setTopStarAvatar($show_dir.'/'.$file)
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
