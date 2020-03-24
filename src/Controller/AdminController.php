<?php

namespace App\Controller;

use App\Entity\Page;
use App\Entity\Categorie;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




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

    /**
     * @Route("/admin/form/page", name="admin.form.page")
     */
    public function pageForm(Request $request, EntityManagerInterface $entitymanager)
    {
        $page =new Page();
        $form = $this->createFormBuilder($page)
        ->add('titre')
        ->add('auteur')
        ->add('createdAt')
        ->add('jourAt')
        ->add('contenu')
        ->add('categorie', EntityType::class, [
            'class' => Categorie::class,
            "choice_label" => 'titre'
      ])
         
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $entitymanager->persist($page); 
        $entitymanager->flush();
        return $this->redirectToRoute('admin.page', 
        ['id'=>$page->getId()]); // Redirection vers la page
        }
        return $this->render('admin/pageform.html.twig', [
            'formPage' => $form->createView()
        ]);
    }


    /**
    * @Route("/admin/page/{id}", name="admin.page.modif")
    */
    
    public function pageModif(Page $page, Request $request, EntityManagerInterface $entitymanager)
    {
        $form = $this->createFormBuilder($page)
        ->add('titre')
        ->add('auteur')
        ->add('createdAt')
        ->add('jourAt')
        ->add('contenu')
        ->add('categorie', EntityType::class, [
            'class' => Categorie::class,
            "choice_label" => 'titre'
    ])
         
        ->getForm();
        $form->handleRequest($request);
                
        if($form->isSubMitted() && $form->isValid()){
            $entitymanager->persist($page);
            $entitymanager->flush();

            return $this->redirectToRoute('admin.page', 
            ['id'=>$page->getId()]); // Redirection vers la page
        }
        return $this->render('admin/pagemodif.html.twig', [
               'formModifPage' => $form->createView()
               ]);
    }
    
    /**
    * @Route("/admin/page/{id}/deletart", name="admin.page.sup")
    */
    
    public function pageSup($id, EntityManagerInterface $entitymanager, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $page = $repo->find($id);

        $entitymanager->remove($page);
        $entitymanager->flush();
        
        return $this->redirectToRoute('admin.page');
    } 

}
