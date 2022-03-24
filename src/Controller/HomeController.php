<?php

namespace App\Controller;

use Doctrine\DBAL\Schema\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController{

    /**
     * @Route("/home", name="home")
     */
    public function home(): Response{
        return $this->render('base.html.twig',['coucou'=>'salut']);
    }
}