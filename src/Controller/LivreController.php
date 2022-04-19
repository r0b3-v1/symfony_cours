<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{
    /**
     * @Route("/livres", name="livres")
     */
    public function index(LivreRepository $lr): Response
    {
        $livres = $lr->findAll();
        return $this->render('livre/index.html.twig', [
            'livres' => $livres,
        ]);
    }

    /**
     * @Route("/livre/nouveau", name="ajouter_livre")
     */
    public function ajouter(LivreRepository $lr, Request $request): Response {
        $livre = new Livre;

        $form = $this->createForm(LivreType::class, $livre)
                    ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            dd($form);
        }

        return $this->render('livre/ajout.html.twig', ['form'=>$form->createView()]);

    }
}
