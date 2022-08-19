<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Collectors;

class DumpController extends AbstractController
{
    #[Route('/collector/dump/{{id}}', name: 'DumpCollector')]
    public function index(ManagerRegistry $doctrine,int $id): Response
    {
        $this->dump=[];
        $this->collector = $doctrine->getManager()->getRepository(Collectors::class)->find($id);
        $this->dumpCollector('series');
        $this->dumpCollector('producents');
        $this->dumpCollector('stars');
        file_put_contents($this->getUrl()."/dump.json", json_encode($this->dump));
        header('Location: http://'.$_SERVER['SERVER_NAME'].'/'.$this->getUrl()."/dump.json");
        exit;
    }

    private function getCollectorDir(string $series)
    {
        return '../public/collectors/'.$this->collector->getCode().'/'.$this->collector->getName().'/'.$series;
    }

    private function getUrl(){
        return 'collectors/'.$this->collector->getCode().'/'.$this->collector->getName();
    }

    private function seriesMovies(string $urldir,array $array) : array{

        if (is_dir($urldir)){
            if ($dh = opendir($urldir)){
              while (($file = readdir($dh)) !== false){
                if ($file != '.'&& $file != '..'){
                    array_push($array,$file);
                }
              }
              closedir($dh);
            }
        }
        return $array;
    }

    private function dumpDir(string $dir,string $indir,string $indir2,string $name){
        $dir=$dir.'/movies';
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                if ($file != '.'&& $file != '..'){
                    $this->dump[$indir][$indir2][$name][$file]=[];
                    $urldir=$dir.'/'.$file;
                    $this->dump[$indir][$indir2][$name][$file] = $this->seriesMovies($urldir,$this->dump[$indir][$indir2][$name][$file]);
                }
              }
              closedir($dh);
            }
        }
    }

    private function openSeries(string $dir,string $index,string $dirindex){
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                if ($file != '.'&& $file != '..'){
                    $this->dump[$dirindex][$index][$file]=[];
                    $ndir=$dir.'/'.$file;
                    $this->dumpDir($ndir,$dirindex,$index,$file);
                }
              }
              closedir($dh);
            }
        }
    }

    private function dumpCollector(string $series){
        $dir = $this->getCollectorDir($series);
        $this->dump[$series]=[];
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
              while (($file = readdir($dh)) !== false){
                if ($file != '.'&& $file != '..'){
                    $this->dump[$series][$file] = [];
                    $in_dir=$dir.'/'.$file;
                    $this->openSeries($in_dir,$file,$series);
                }
              }
              closedir($dh);
            }
        }
    }
}
