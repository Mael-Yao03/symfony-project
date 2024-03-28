<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route("/contact", name:"contact")]
    public function saving()
    {
        return $this->render('contact.html.twig');
    }

    #[Route('/send', name: 'app_contact', methods:['POST'])]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $dataForm = $request->request->all();
        $datenow = new \DateTime();
    
        $contact = new Contact();
        $contact->setNom($dataForm['nom']);
        $contact->setEmail($dataForm['email']);
        $contact->setMessage($dataForm['message']);
        $contact->setDateCreatead($datenow);
    
        $em->persist($contact);
        $em->flush();

        $this->addFlash('success', 'Message envoyé !');
        return $this->redirectToRoute('contact');
    }
}
