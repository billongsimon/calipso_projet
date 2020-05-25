<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}