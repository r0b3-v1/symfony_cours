<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\DBAL\Schema\View;
use App\Repository\AdresseRepository;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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
    public function test(ContactRepository $cr): Response{
        //retrieve all contacts
        $contacts = $cr->findAll();


        return $this->render('contacts/list.html.twig', ['contacts'=>$contacts]);
    }

    /**
     * @Route("home/test/{id}/details", name="details-contact")
     */
    public function details($id,ContactRepository $cr){
        $contact = $cr->find($id);

        return $this->render('contacts/contact.html.twig',['contact'=>$contact]);
    }

    /**
     * @Route("home/test/{id}/delete", name="delete-contact")
     */
    public function delete($id, ContactRepository $cr){
        $cr->remove($cr->find($id));
        return $this->redirectToRoute('test');
    }

    /**
     * @Route("home/test/create", name="create-contact")
     */
    function create(ContactRepository $cr, Request $request){
        $contact = new Contact;

        // creation du formulaire

        $builder = $this->createFormBuilder($contact);
        $builder->add('prenom', TextType::class, ['required' => true]);
        $builder->add('nom', TextType::class, ['required' => true]);
        $builder->add('numTel', TextType::class, ['required' => true,
                    'constraints' => [new Length(['min' => 10])],
                    ]);
        $builder->add('email', EmailType::class, ['required' => true, 'mapped'=>false]);
        $builder->add('submit', SubmitType::class, ['label' => 'envoyer']);
        
        $formulaire = $builder->getForm();
        $formulaire->handleRequest($request);

        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $cr->add($contact);
            return  $this->redirectToRoute('test');
        }
        else
            return $this->render('create.html.twig',['formView'=>$formulaire->createView()]);
        // $contact->setPrenom("Jean-Paul");
        // $contact->setNom("Jarre");
        // $contact->setNumTel("5343");
        // $contact->setDateNaissance(null);

        
    }
    /**
     * @Route("home/test/{id}/update", name="update-contact")
     */
    function update($id, ContactRepository $cr, Request $request){
        $contact = $cr->find($id);

        // creation du formulaire

        $formulaire = $this->createForm(ContactType::class, $contact);

        $formulaire->handleRequest($request);

        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $cr->add($contact);
            return  $this->redirectToRoute('test');
        }
        else
            return $this->render('create.html.twig',['formView'=>$formulaire->createView()]);
        
    }
}