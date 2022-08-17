<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericListController;
use App\Generic\GenericSetDataInterFace;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Series;

class SeriesTopStarsController extends GenericListController implements GenericSetDataInterFace
{
    protected bool $paginate = TRUE;
    protected int $per_page = 20;
    private Series $series;
    public function setData(): void
    {
        $this->setEntity(Series::class);
        $this->setTwig('show/series/topstars.twig');
    }

    protected function onSetAttribut() :array
    {
        return  [
            'Collector'   => $this->returnUrlArguments('collector'),
            'ObjectData' => $this->series,
        ];
    }

    private function setTopStarAvatar(string $url){
        return $url.'/avatar.jpeg';
    }

    public function onQuerySet(ServiceEntityRepository $entityManager)
    {
        $this->series = $entityManager->find($this->returnUrlArguments('id'));
        return $this->topStars();
    }

    private function topStars(){
        $top_stars=[];
        $dir = $this->series->getDir();
        $dir = '../public/collectors/'.$dir.'/stars';
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                if (is_dir($dir)){
                    if ($file != '.'&& $file != '..'){
                        $show_dir='/collectors//'.$this->series->getDir().'/stars';
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


