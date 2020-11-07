<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManager; //import de Doctrine
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SaisiePersonneType;
use App\Entity\Personne;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personne", name="personne")
     */
    public function index()
    {
        $doc = $this->getDoctrine();
        $man = $doc->getManager();
        $repoPers = $man->getRepository('\App\Entity\Personne');
        $res = $repoPers->findAll();
        return $this->render('personne/index.html.twig', [
            'res' => $res,
        ]);
    }
    
    /**
     * @Route("/saisie", name="saisie")
     */
    public function select(Request $req){
        
        $form = $this->createForm(SaisiePersonneType::class,null,[
            'action' => '/essai',
        ]);
        $form->handleRequest($req);
        $response = $this->render('personne/vue.html.twig', [
            'formulaire' => $form->createView(),
        ]);
        return $response;
    }
    
    /**
     * @Route("/essai", name="essai")
     */
    public function essai(Request $req){
        print_r($_POST);
        exit;
        $nom = "fdhgfgd";
        $prenom = "12ccjdh3";
        $date_de_naissance = new \DateTime('1990-05-26');
        $niveau = 643;
        $mail = "tdfvjvjhest@gmail.com";
        $new = new Personne($nom,$prenom,$date_de_naissance,$niveau,$mail);
        $doct = $this->getDoctrine();
        $man = $doct->getManager();
        $man->persist($new);
        $man->flush();
        
        return $this->redirectToRoute('personne');
    }
    
}
