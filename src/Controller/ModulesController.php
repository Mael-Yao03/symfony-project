<?php

namespace App\Controller;

use App\Entity\Modules;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModulesController extends AbstractController
{
    #[Route('/modules', name: 'app_modules', methods:['GET'])]
    public function index(ManagerRegistry $mr): JsonResponse
    {
        $modules = $mr->getRepository(Modules::class)->findAll();

     /*  return $this->render('form.html.twig', [
            'modules' => $modules,
        ]);*/

        $data = [];

        foreach ($modules as $module) {
            $data[] = [
                'id' => $module->getId(),
                'nom' => $module->getNom(),
                'description' => $module->getDescription(),
            ];
        }
        return $this->render('form.html.twig', [
            'data' => $data,
            'modules' => $modules,
        ]);
    }

    #[Route('/modules/send', name: 'create_module', methods:['POST'])]
    public function create( Request $request, EntityManagerInterface $em): JsonResponse
    {
        if ($request->isMethod('POST')) {
            $data = json_decode($request->getContent(), true);
    
            if (!isset($data['nom']) || empty($data['nom'])) {
                return new JsonResponse(['error' => 'Le nom du module est obligatoire'], 400);
            }
    
            if (!isset($data['description']) || empty($data['description'])) {
                return new JsonResponse(['error' => 'La description du module est obligatoire'], 400);
            }
    
            $Module = new Modules();
            $Module->setNom($data['nom']);
            $Module->setDescription($data['description']);
            $Module->setIsActive($data['isActive']);
    
            $em->persist($Module);
            $em->flush();
    
            return new JsonResponse([
                'id' => $Module->getId(),
                'nom' => $Module->getNom(),
                'description' => $Module->getDescription(),
            ]);
        }
    }
}
