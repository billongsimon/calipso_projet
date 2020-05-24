<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontofficeController extends AbstractController
{
    /**
     * @Route("/frontoffice", name="frontoffice")
     */
    public function index()
    {
        return $this->render('frontoffice/index.html.twig', [
            'controller_name' => 'FrontofficeController',
        ]);
    }
}
