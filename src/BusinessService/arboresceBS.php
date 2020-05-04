<?php

namespace App\BusinessService;


use App\Entity\Page;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


class ArborescenceBS
{

    /**
     * @var w3DS
     */
    private $w3DS;

    public function __construct(w3DS $w3DS)
    {
        $this->w3DS = $w3DS;
    }

    function arbreBS($items) {

        $childs = [];
    
        foreach ($items as $item)
            $childs[$item->parent_id][] = $item;
    
        foreach ($items as $item) if (isset($childs[$item->id]))
            $item->childs = $childs[$item->id];
    
        return $childs[0];
    }

  
}
