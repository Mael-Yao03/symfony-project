<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MyController extends AbstractController
{
    #[Route("/", name:"Acceuil")]
    public function bet(): Response
    {
        return $this->render('home.html.twig');

    }

    #[Route("/add", name:"Insertion")]
    public function base(): Response
    {
        return $this->render('form.html.twig');
    }



   

    
}
?>