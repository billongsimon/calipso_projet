<?php

namespace App\Controller;
use App\Entity\Page;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @Route("/admin/index", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route("/admin/page", name="admin.page")
     */
    public function page(Request $request)
    {
        $repo=$this->getDoctrine() ->getRepository(Page::class);
        $pages=$repo->findAll();
            
             
        return $this->render('admin/page.html.twig', [
            'controller_name' => 'AdminController',
        'pages'=>$pages
            ]);
    }

}
