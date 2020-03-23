<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Page;
use App\Entity\Categorie;
use App\Entity\Utilisateur;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\DateType;




class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @Route("/admin/index", name="admin")
     */
    public function index(paginatorInterface $paginator, request $request)
    {
       
        $repo=$this->getDoctrine() ->getRepository(Page::class);
        $pages=$paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1), /*page number*/
             9 /*limit per page*/     );

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'pages'=>$pages
        ]);
    }
    /**
     * @Route("/admin/page", name="admin.page")
     */
    public function page(Request $request)
    {
        $repo=$this->getDoctrine() ->getRepository(Page::class);
        $page=$repo->findAll();
        
            
             
        return $this->render('admin/page.html.twig', [
            'controller_name' => 'AdminController',
        'page'=>$page
            ]);
    }
        /**
      * @Route("admin/show/{id}", name="admin.show")
     */
    public function show($id, Request $request)
    {
        $repo=$this->getDoctrine() ->getRepository(Page::class);
        $page=$repo->find($id);
               
        return $this->render('admin/show.html.twig', [
            'controller_name' => 'AdminController',
        'page'=>$page
            ]);
    }

}
