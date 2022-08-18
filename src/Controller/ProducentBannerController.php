<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Generic\GenericSetDataInterFace;
use App\Generic\GenericListController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\Producent;

class ProducentBannerController extends GenericListController implements GenericSetDataInterFace
{
    protected bool $paginate = TRUE;
    protected int $per_page = 10;
    private Producent $Producent;
    public function setData(): void
    {
        $this->setEntity(Producent::class);
        $this->setTwig('show/producent/banners.twig');
    }

    protected function onSetAttribut() :array
    {
        return  [
            'ObjectData' => $this->Producent,
            'Collector'  => $this->returnUrlArguments('collector')
        ];
    }

    public function onQuerySet(ServiceEntityRepository $entityManager)
    {
        $this->Producent = $entityManager->find($this->returnUrlArguments('id'));
        return $this->returnBanners();
    }

    private function returnBanners(){
        $photos=[];
        $dir = $this->Producent->getDir();
        $dir = '../public/collectors/'.$dir.'/banners';
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                if (is_dir($dir)){
                    if ($file != '.'&& $file != '..'){
                        array_push($photos,'/collectors//'.$this->Producent->getDir().'/banners//'.$file);
                    }
                }
              }
              closedir($dh);
            }
        }
        return $photos;
    }
}