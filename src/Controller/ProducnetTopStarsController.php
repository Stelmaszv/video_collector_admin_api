<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericSetDataInterFace;
use App\Generic\GenericListController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Producent;

class ProducnetTopStarsController extends GenericListController implements GenericSetDataInterFace
{
    protected bool $paginate = TRUE;
    protected int $per_page = 20;
    private Producent $producent;
    public function setData(): void
    {
        $this->setEntity(Producent::class);
        $this->setTwig('show/producent/topstars.twig');
    }

    protected function onSetAttribut() :array
    {
        return  [
            'Collector'   => $this->returnUrlArguments('collector'),
            'ObjectData' => $this->producent,
        ];
    }

    private function setTopStarAvatar(string $url){
        return $url.'/avatar.jpeg';
    }

    public function onQuerySet(ServiceEntityRepository $entityManager)
    {
        $this->producent = $entityManager->find($this->returnUrlArguments('id'));
        return $this->topStars();
    }

    private function topStars(){
        $top_stars=[];
        $dir = $this->producent->getDir();
        $dir = '../public/collectors/'.$dir.'/stars';
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                if (is_dir($dir)){
                    if ($file != '.'&& $file != '..'){
                        $show_dir='/collectors//'.$this->producent->getDir().'/stars';
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
