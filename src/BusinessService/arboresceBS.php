<?php

namespace App\BusinessService;


use App\Entity\Page;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;



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


    function arbreBS($array, $currentParent, $currLevel = 0, $prevLevel = -1) {
         
        foreach ($array as $pageId => $page) {
         
        if ($currentParent == $page['page_parent_id']) {                       
            if ($currLevel > $prevLevel) echo " <ol class='tree'> "; 
         
            if ($currLevel == $prevLevel) echo " </li> ";
         
            echo '<li> <label for="subfolder2">'.$category['name'].'</label> <input type="checkbox" name="subfolder2"/>';
         
            if ($currLevel > $prevLevel) { $prevLevel = $currLevel; }
         
            $currLevel++; 
         
            createTreeView ($array, $pageId, $currLevel, $prevLevel);
         
            $currLevel--;               
            }   
         
        }
         
        if ($currLevel == $prevLevel) echo " </li>  </ol> ";
         
        }
    }        