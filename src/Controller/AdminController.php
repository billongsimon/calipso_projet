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
     * @Route("/admin/page/new", name="admin.form.page")
     */
    public function pageForm (Request $request, EntityManagerInterface $manager)
    {
        $page =new Page();
        $categorie =new Categorie();
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
        $manager->persist($page); 
        $manager->flush();
        return $this->redirectToRoute('admin.page', 
        ['id'=>$page->getId()]); // Redirection vers la page
        }
        return $this->render('admin/pageform.html.twig', [
            'formPage' => $form->createView()
        ]);
    }


    /**
    * @Route("/admin/page/edit/{id}", name="admin.page.modif")
    */
    
    public function pageModif(page $page, Request $request, EntityManagerInterface $manager)
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
            $manager->persist($page);
            $manager->flush();

            return $this->redirectToRoute('admin.page', 
            ['id'=>$page->getId()]);
        }
        return $this->render('admin/pagemodif.html.twig', [
               'formModifPage' => $form->createView()
               ]);
    }
    /**
    * @Route("/admin/page/delete/{id}", name="admin.page.sup")
    */
    
    public function pageSup($id, EntityManagerInterface $manager, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Page::class);
        $page = $repo->find($id);

        $manager->remove($page);
        $manager->flush();
        
        return $this->redirectToRoute('admin.page');
    }
    /**
     * @Route("/admin/categorie", name="admin.categorie")
     */
    public function categorie(Request $request)
    {
        $repos=$this->getDoctrine() ->getRepository(Categorie::class);
        $categories=        $repos->findAll();
            
        return $this->render('admin/categorie.html.twig', [
            'controller_name' => 'AdminController',
        'categories'=>$categories
            ]);
    }

    /**
     * @Route("/admin/form/categorie", name="admin.form.categorie")
     */
    public function categorieForm(Request $request, EntityManagerInterface $manager)
    {
        $categorie = new Categorie();
        $form = $this->createFormBuilder($categorie)
        ->add('titre')
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        $manager->persist($categorie); 
        $manager->flush();
        return $this->redirectToRoute('admin.categorie', 
        ['id'=>$categorie->getId()]); // Redirection vers
        }
        return $this->render('admin/catform.html.twig', [
            'formCategorie' => $form->createView()
        ]);
    }
    /**
    * @Route("/admin/categorie/edit/{id}", name="admin.categorie.modif")
    */
    
    public function modifCategorie(categorie $categorie, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createFormBuilder($categorie)
        ->add('titre')
        ->getForm();
        $form->handleRequest($request);
                
        if($form->isSubMitted() && $form->isValid()){
        $manager->persist($categorie);
        $manager->flush();

        return $this->redirectToRoute('admin.categorie', 
        ['id'=>$categorie->getId()]);
        }
        return $this->render('admin/catmodif.html.twig', [
        'formModifCat' => $form->createView()
        ]);
    }
    /**
    * @Route("/admin/categorie/delete/{id}", name="admin.categorie.sup")
    */
    
    public function supCategorie($id, EntityManagerInterface $manager, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Categorie::class);
        $categorie = $repo->find($id);

        $manager->remove($categorie);
        $manager->flush();
        
        return $this->redirectToRoute('admin.categorie');
    }


}

    
 
