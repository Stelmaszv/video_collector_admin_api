<?php
namespace App\Controller;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UserCollector;
use App\Repository\UserCollectorRepository;

class CollectorScanController extends AbstractController
{
    #[Route('/collectorscan/{{controller}}/{{controllerid}}', name: 'CollectorScan')]
    public function index(string $controller,int $controllerid,ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getManager()->getRepository(UserCollector::class);
        if ($this->can_edit($repository,$controllerid)){
            return $this->render('collector_scan/index.html.twig', [
            'controller_name' => 'CollectorScanController',
            ]);
        }else{
            return $this->render('collector_scan/index.html.twig', [
                'controller_name' => 'CollectorScanController',
            ]);
        }
    }

    private function can_edit(UserCollectorRepository $repository, int $controllerid): bool
    {
        return $repository->can_edit($this->getUser(),$controllerid);
    }
}
