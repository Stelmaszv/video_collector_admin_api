<?php
namespace App\Generic;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Generic\Generic;
use App\Generic\GenericInterFace;
use Knp\Component\Pager\PaginatorInterface;


class GenericDetailController extends AbstractController implements GenericInterFace
{
    use Generic;
    private int $id;

    public function detailView(ManagerRegistry $doctrine,Request $request,int $id,PaginatorInterface $paginator): Response
    {
        $this->id=$id;
        $this->paginator= $paginator;
        return $this->baseView($doctrine,$request);
    }

    public function onQuerySet(ServiceEntityRepository $entityManager)
    {
        return $entityManager->find($this->id);
    }
}