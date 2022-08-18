<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('empty', [$this, 'emptyfilter']),
            new TwigFilter('photo', [$this, 'photofilter'])
        ];
    }

    public function photofilter($avatar, string $type = 'normal'): string
    {
        $url_array=explode('\\',$avatar);
        if (count($url_array)<3){
            return '/assts/'.$type.'.png';
        }
        return '/collectors/'.$avatar;
    }

    public function emptyfilter($text): string
    {
        if (empty($text) || $text==NULL ){
            return 'No data !';
        }
        return $text;
    }
}