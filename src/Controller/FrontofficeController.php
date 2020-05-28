<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Page;
use Symfony\Component\HttpFoundation\Request;



class FrontofficeController extends AbstractController
{
    /**
     * @Route("/", name="frontoffice")
     */
    public function index()
    {
        return $this->render('frontoffice/index.html.twig', [
            'controller_name' => 'FrontofficeController',
        ]);
    }
      /**
     * @Route("/page", name="frontoffice_page")
     */
    public function page()
    {
        return $this->render('frontoffice/page.html.twig', [
            'controller_name' => 'FrontofficeController',
        ]);
    }
      
    /**
     * @Route("/page2", name="FRINTOFFICE-PAGE2")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    // les 3 dernieres pages
    public function lastpage(Request $request)
    {
        
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $page = $repo-> findLastPages();
        
    //  dump($page);die;
    
        return $this->render('frontoffice/page2.html.twig', [
            'controller_name' => 'FrontofficeController',
            'page'            => $page,
       
          
        ]);
            
    }
  
}