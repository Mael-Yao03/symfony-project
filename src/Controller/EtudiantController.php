<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    #[Route('/save', name: 'sauvegarde', methods: ['POST'])]
    public function save(Request $request, EntityManagerInterface $em)
    {
        $dataForm = $request->request->all();
        $naissance = $dataForm['date_naissance'];
        $datenaissance = new \DateTime($naissance);
        $datenow = new \DateTime();
    
        $Etudiant = new Etudiant();
        $Etudiant->setNom($dataForm['nom']);
        $Etudiant->setPrenoms($dataForm['prenoms']);
        $Etudiant->setDateNaissance($datenaissance);
        $Etudiant->setNiveauScolaire($dataForm['niveau_scolaire']);
        $Etudiant->setModuleChoisit($dataForm['module_choisit']);
        $Etudiant->setMotifInscription($dataForm['motif_inscription']);
        $Etudiant->setDateCreated($datenow);
    
        $em->persist($Etudiant);
        $em->flush();

        $this->addFlash('success', 'Vous êtes enregistré (e) !');
        return $this->redirectToRoute('Insertion');   
    }


    #[Route("/array", name:"tableau")]
    public function view(ManagerRegistry $mr, Request $request, PaginatorInterface $paginator )
    {
        $dbd = $paginator->paginate(
            $mr->getRepository(Etudiant::class)->findAll(),
            $request->query->getInt('page', 1), 
            10,
        );

          

        $displayedIds = [];
    
        return $this->render('array.html.twig', [
            'dbd' => $dbd, 
            'displayedIds' => $displayedIds,
        ]);
    }

    #[Route("/modif/{Id}", name:"update_etudiant",  methods: ['POST'])]
    public function modif(Etudiant $Etudiant, Request $request, EntityManagerInterface $em)
    {
        if ($request->isMethod('POST')) {
            
            $dataForm = $request->request->all();
            
            $Etudiant->setNom($dataForm['nom']);
            $Etudiant->setPrenoms($dataForm['prenoms']);
            $Etudiant->setDateNaissance(new \DateTime($dataForm['date_naissance']));
            $Etudiant->setNiveauScolaire($dataForm['niveau_scolaire']);
            $Etudiant->setModuleChoisit($dataForm['module_choisit']);
            $Etudiant->setMotifInscription($dataForm['motif_inscription']);
    
            $em->flush();
            $this->addFlash('success', 'Modifications enregistrées !');
            return $this->redirectToRoute('tableau'); 
        }
    
        return $this->render('modif.html.twig', ['etudiant' => $Etudiant,]);
    }
    
    #[Route("/delete/{id}", name: "delete_etudiant")]
    public function supprimer(Etudiant $Etudiant, EntityManagerInterface $em)
    {
       $em->remove($Etudiant);
       $em->flush();

      $this->addFlash('success', 'Étudiant supprimé avec succès !');
      return $this->redirectToRoute('tableau');
}

    

}



