<?php

​

namespace App\Controller;

​

use App\Entity\Categorie;

use App\Entity\Page;

use Doctrine\ORM\EntityManagerInterface;

use Knp\Component\Pager\PaginatorInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

​

​

/**

 * @Route("admin")

 */

class AdminController extends AbstractController

{

    /**

     * @Route("/", name="admin")

     *

     * @param Request $request

     * @param PaginatorInterface $paginator

     * @return \Symfony\Component\HttpFoundation\Response

     */

    public function index(Request $request, PaginatorInterface $paginator)

    {

​

        $repo = $this->getDoctrine()->getRepository(Page::class);

        $pages = $paginator->paginate(

            $repo->findAll(),

            $request->query->getInt('page', 1), /*page number*/

            9 /*limit per page*/);

​

        return $this->render('admin/index.html.twig', [

            'controller_name' => 'AdminController',

            'pages'           => $pages

        ]);

    }

​

    /**

     * @Route("/page", name="admin.page")

     *

     * @param Request $request

     * @return \Symfony\Component\HttpFoundation\Response

     */

    public function page(Request $request)

    {

        $repo = $this->getDoctrine()->getRepository(Page::class);

        $page = $repo->findAll();

​

        return $this->render('admin/page.html.twig', [

            'controller_name' => 'AdminController',

            'page'            => $page

        ]);

    }

​

    /**

     * @Route("admin/show/{id}", name="admin.show")

     *

     * @param Request $request

     * @param $id

     * @return \Symfony\Component\HttpFoundation\Response

     */

    public function show(Request $request, $id)

    {

        $repo = $this->getDoctrine()->getRepository(Page::class);

        $page = $repo->find($id);

​

        return $this->render('admin/show.html.twig', [

            'controller_name' => 'AdminController',

            'page'            => $page

        ]);

    }

​

    /**

     * @Route("/page/new", name="admin.form.page")

     *

     * @param Request $request

     * @param EntityManagerInterface $manager

     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response

     */

    public function pageForm(Request $request, EntityManagerInterface $manager)

    {

        $page = new Page();

        $categorie = new Categorie();

        $form = $this->createFormBuilder($page)

            ->add('titre')

            ->add('auteur')

            ->add('createdAt', DateType::class)

            ->add('jourAt', DateType::class)

            ->add('contenu')

            ->add('categorie', EntityType::class, [

                'class'        => Categorie::class,

                "choice_label" => 'titre'

            ])

            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($page);

            $manager->flush();

            return $this->redirectToRoute('admin.page',

                ['id' => $page->getId()]); // Redirection vers la page

        }

        return $this->render('admin/pageform.html.twig', [

            'formPage' => $form->createView()

        ]);

    }

​

​

    /**

     * @Route("/page/edit/{id}", name="admin.page.modif")

     *

     * @param Request $request

     * @param EntityManagerInterface $manager

     * @param Page $page

     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response

     */

    public function pageModif(Request $request, EntityManagerInterface $manager, Page $page)

    {

        $form = $this->createFormBuilder($page)

            ->add('titre')

            ->add('auteur')

            ->add('createdAt', DateType::class)

            ->add('jourAt', DateType::class)

            ->add('contenu')

            ->add('categorie', EntityType::class, [

                'class'        => Categorie::class,

                "choice_label" => 'titre'

            ])

            ->getForm();

        $form->handleRequest($request);

​

        if ($form->isSubMitted() && $form->isValid()) {

            $manager->persist($page);

            $manager->flush();

​

            return $this->redirectToRoute('admin.page',

                ['id' => $page->getId()]);

        }

        return $this->render('admin/pagemodif.html.twig', [

            'formModifPage' => $form->createView()

        ]);

    }

​

    /**

     * @Route("/page/delete/{id}", name="admin.page.sup")

     *

     * @param Request $request

     * @param EntityManagerInterface $manager

     * @param $id

     * @return \Symfony\Component\HttpFoundation\RedirectResponse

     */

    public function pageSup(Request $request, EntityManagerInterface $manager, $id)

    {

        $repo = $this->getDoctrine()->getRepository(Page::class);

        $page = $repo->find($id);

​

        $manager->remove($page);

        $manager->flush();

​

        return $this->redirectToRoute('admin.page');

    }

​

    /**

     * @Route("/categorie", name="admin.categorie")

     *

     * @param Request $request

     * @return \Symfony\Component\HttpFoundation\Response

     */

    public function categorie(Request $request)

    {

        $repos = $this->getDoctrine()->getRepository(Categorie::class);

        $categories = $repos->findAll();

​

        return $this->render('admin/categorie.html.twig', [

            'controller_name' => 'AdminController',

            'categories'      => $categories

        ]);

    }

​

    /**

     * @Route("/form/categorie", name="admin.form.categorie")

     *

     * @param Request $request

     * @param EntityManagerInterface $manager

     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response

     */

    public function categorieForm(Request $request, EntityManagerInterface $manager)

    {

        $categorie = new Categorie();

        $form = $this->createFormBuilder($categorie)

            ->add('titre')

            ->getForm();

​

        $form->handleRequest($request);

​

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($categorie);

            $manager->flush();

            return $this->redirectToRoute('admin.categorie',

                ['id' => $categorie->getId()]); // Redirection vers

        }

        return $this->render('admin/catform.html.twig', [

            'formCategorie' => $form->createView()

        ]);

    }

​

    /**

     * @Route("/categorie/edit/{id}", name="admin.categorie.modif")

     *

     * @param Request $request

     * @param EntityManagerInterface $manager

     * @param Categorie $categorie

     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response

     */

    public function modifCategorie(Request $request, EntityManagerInterface $manager, Categorie $categorie)

    {

        $form = $this->createFormBuilder($categorie)

            ->add('titre')

            ->getForm();

        $form->handleRequest($request);

​

        if ($form->isSubMitted() && $form->isValid()) {

            $manager->persist($categorie);

            $manager->flush();

​

            return $this->redirectToRoute('admin.categorie',

                ['id' => $categorie->getId()]);

        }

        return $this->render('admin/catmodif.html.twig', [

            'formModifCat' => $form->createView()

        ]);

    }

​

    /**

     * @Route("/categorie/delete/{id}", name="admin.categorie.sup")

     *

     * @param Request $request

     * @param EntityManagerInterface $manager

     * @param $id

     * @return \Symfony\Component\HttpFoundation\RedirectResponse

     */

    public function supCategorie(Request $request, EntityManagerInterface $manager, $id)

    {

        $repo = $this->getDoctrine()->getRepository(Categorie::class);

        $categorie = $repo->find($id);

​

        $manager->remove($categorie);

        $manager->flush();

​

        return $this->redirectToRoute('admin.categorie');

    }

}