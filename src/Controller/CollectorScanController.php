<?php
namespace App\Controller;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserCollector;
use App\Repository\UserCollectorRepository;
use App\Entity\Series;
use App\Entity\Producent;
use App\Entity\Movies;
use App\Entity\Stars;

class CollectorScanController extends AbstractController
{
    private string $collector='';

    #[Route('/collectorscan/{{collector}}/{{controllerid}}', name: 'CollectorScan')]
    public function index(string $collector,int $controllerid,ManagerRegistry $doctrine): Response
    {
        $this->collector=$collector;
        $repository = $doctrine->getManager()->getRepository(UserCollector::class);
        if ($this->canEdit($repository,$controllerid)){
            $json = $this->getDist($this->collector);
            //$this->addProducents($json->producents,$doctrine);
            $this->addSeries($json->series,$doctrine);
            $this->addMovies($json->movies,$doctrine);
            //$this->addStars($json->stars,$doctrine);
            
            return $this->redirectToRoute('MoviesList',[
                'collector'=> $this->collector
            ]);
        }else{
            return $this->redirectToRoute('Authorized');
        }
    }

    private function addStars($array,$doctrine){
        $repository = $doctrine->getManager()->getRepository(Stars::class);
        foreach($array as $elemnt){
            $entity=$repository->faindIfExist($elemnt->name);
            if (!$entity){
                $entity= new Stars();
            }
            $em = $doctrine->getManager();
            $entity->setName($elemnt->name);
            $entity->setDir($this->getUrl($elemnt->dir)); 
            $entity->setShowName($elemnt->show_name);
            $entity->setDescription($elemnt->description);
            $data= \DateTime::createFromFormat('Y-m-d', $elemnt->date_of_birth);
            if ($data){
                $entity->setDateRelesed($data);
            }
            $entity->setAvatar($this->getUrl($elemnt->avatar));
            $entity->getNationality($elemnt->nationality);
            $entity->setWeight($elemnt->weight);
            $entity->setHeight($elemnt->height);
            $em->persist($entity);
            $em->flush();
        }
    }

    private function addMovies($array,ManagerRegistry $doctrine){
        $repository = $doctrine->getManager()->getRepository(Movies::class);
        foreach($array as $elemnt){
            $entity=$repository->faindIfExist($elemnt->name);
            if (!$entity){
                $entity= new Movies();
            }
            $em = $doctrine->getManager();
            $entity->setName($elemnt->name);
            $entity->setFullName($elemnt->full_name);
            $entity->setDir($this->getUrl($elemnt->dir)); 
            $entity->setShowName($elemnt->show_name);
            $entity->setDescription($elemnt->description);
            $entity->setSrc($this->getUrl($elemnt->src));
            $entity->setCountry($elemnt->country);
            $entity->setPoster($this->getUrl($elemnt->poster));
            $entity->setCover($this->getUrl($elemnt->cover));
            $entity->setSerie($this->setSeries($elemnt->series,$em));
            $data= \DateTime::createFromFormat('Y-m-d', $elemnt->date_relesed);
            if ($data){
                $entity->setDateRelesed($data);
            }
            $em->persist($entity);
            $em->flush();
        }
    }

    private function setSeries(string $seriesmaname,$em)
    {
        $series = $em->getRepository(Series::class);
        return $series->findOneBy(['name' => $seriesmaname]);
    }

    private function addProducents($array,ManagerRegistry $doctrine){
        $repository = $doctrine->getManager()->getRepository(Producent::class);
        foreach($array as $elemnt){
            $entity=$repository->faindIfExist($elemnt->name);
            if (!$entity){
                $entity= new Producent();
            }
            $em = $doctrine->getManager();
            $entity->setName($elemnt->name);
            $entity->setDir($this->getUrl($elemnt->dir)); 
            $entity->setShowName($elemnt->show_name);
            $entity->setDescription($elemnt->description);
            $entity->setCountry($elemnt->country);
            $em->persist($entity);
            $em->flush();
        }
        
    }

    private function addSeries($array,ManagerRegistry $doctrine){
        $repository = $doctrine->getManager()->getRepository(Series::class);
        foreach($array as $elemnt){
            $entity=$repository->faindIfExist($elemnt->name);
            if (!$entity){
                $entity= new Series();
            }
            $em = $doctrine->getManager();
            $entity->setName($elemnt->name);
            $entity->setDir($this->getUrl($elemnt->dir));
            $entity->setShowName($elemnt->show_name);
            $entity->setDescription($elemnt->description);
            $entity->setCountry($this->getUrl($elemnt->country));
            $entity->setYears($elemnt->years);
            $entity->setNumberOfSezons($elemnt->number_of_sezons);
            $em->persist($entity);
            $em->flush();
        }
    }

    private function getDist(string $controller)
    {
        $petsJson = file_get_contents('../public/collectors/'.$controller.'/dist.json');
        return json_decode($petsJson);
    }

    private function canEdit(UserCollectorRepository $repository, int $controllerid): bool
    {
        return $repository->can_edit($this->getUser(),$controllerid);
    }

    private function getUrl(string $url):string
    {
        
        $url_array=explode('\\',$url);
        $return_url='';
        $url_txt_add=FALSE;
        $el=0;
        foreach($url_array as $url_el){
            if ($url_el==$this->collector){
                $url_txt_add=TRUE;
            }

            if ($url_txt_add){
                $return_url.=$url_el;
                if($el<count($url_array)-1){
                    $return_url.='/';
                }
            }
            $el++;
        }
        return $return_url;
    }

}
