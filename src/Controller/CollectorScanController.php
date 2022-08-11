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
    #[Route('/collectorscan/{{controller}}/{{controllerid}}', name: 'CollectorScan')]
    public function index(string $controller,int $controllerid,ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getManager()->getRepository(UserCollector::class);
        if ($this->can_edit($repository,$controllerid)){
            $json = $this->getDist($controller);
            $this->addProducents($json->producents,$doctrine);
            $this->addSeries($json->series,$doctrine);
            $this->addMovies($json->movies,$doctrine);
            $this->addStars($json->stars,$doctrine);
            
            return $this->render('collector_scan/index.html.twig', [
            'controller_name' => 'CollectorScanController',
            ]);
        }else{
            return $this->render('collector_scan/index.html.twig', [
                'controller_name' => 'canot add',
            ]);
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
            $entity->setDir($elemnt->dir); 
            $entity->setShowName($elemnt->show_name);
            $entity->setDescription($elemnt->description);
            $data= \DateTime::createFromFormat('Y-m-d', $elemnt->date_of_birth);
            if ($data){
                $entity->setDateRelesed($data);
            }
            $entity->setAvatar($elemnt->avatar);
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
            $entity->setDir($elemnt->dir); 
            $entity->setShowName($elemnt->show_name);
            $entity->setDescription($elemnt->description);
            $entity->setSrc($elemnt->dir);
            $entity->setCountry($elemnt->country);
            $entity->setPoster($elemnt->poster);
            $entity->setCover($elemnt->cover);
            $data= \DateTime::createFromFormat('Y-m-d', $elemnt->date_relesed);
            if ($data){
                $entity->setDateRelesed($data);
            }
            $em->persist($entity);
            $em->flush();
        }
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
            $entity->setDir($elemnt->dir); 
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
            $entity->setDir($elemnt->dir);
            $entity->setShowName($elemnt->show_name);
            $entity->setDescription($elemnt->description);
            $entity->setCountry($elemnt->country);
            $entity->setYears($elemnt->years);
            $entity->setNumberOfSezons($elemnt->number_of_sezons);
            $em->persist($entity);
            $em->flush();

        }
    }

    private function getDist(string $controller)
    {
        $petsJson = file_get_contents('../collectors/'.$controller.'/dist.json');
        return json_decode($petsJson);
    }

    private function can_edit(UserCollectorRepository $repository, int $controllerid): bool
    {
        return $repository->can_edit($this->getUser(),$controllerid);
    }

}
