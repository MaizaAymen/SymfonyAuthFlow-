<?php

namespace App\Controller;

use App\Entity\Livre4;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivreController extends AbstractController
{
    #[Route('/livre4', name: 'app_livre4')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $livres = $entityManager->getRepository(Livre4::class)->findAll();
        return $this->render('index.html.twig', ['livres' => $livres]);
    }   
    
    #[Route('/livres/ajouter', name: 'app_livre_ajouter', methods: ['POST', 'GET'])]
    public function ajouter(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $livre = new Livre4();
            $livre->setTitre($request->request->get('titre'));
            $livre->setAuteur($request->request->get('auteur'));
            $livre->setDateDuPub(new \DateTime($request->request->get('datePublication')));

            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('app_livre4');
        }

        return $this->render('ajouter.html.twig');
    }

    #[Route('/livres/supprimer/{id}', name: 'app_livre_supprimer')]
    public function supprimer(Livre4 $livre, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($livre);
        $entityManager->flush();
        return $this->redirectToRoute('app_livre4'); 
    }
}
