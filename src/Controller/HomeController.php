<?php

namespace App\Controller;

use App\Repository\AdresseRepository;
use App\Repository\ContactRepository;
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

    /**
     * @Route("/home/test", name="test")
     */
    public function test(ContactRepository $cr, AdresseRepository $a): Response{
        //retrieve all contacts
        $contacts = $cr->findAll();

        return $this->render('list.html.twig', ['contacts'=>$contacts]);
    }

    /**
     * @Route("home/test/{id}/details", name="detail-contact{id}")
     */
    public function details($id,ContactRepository $cr){
        $contact = $cr->find($id);

        return $this->render('contact.html.twig',['contact'=>$contact]);
    }

}