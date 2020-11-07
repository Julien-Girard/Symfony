<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantFromProfViewController extends AbstractController
{
    /**
     * @Route("/prof/listEleve", name="listEleve")
     */
    
    public function list(){
        $doc = $this->getDoctrine();
        $man = $doc->getManager();
        $repoEtu = $man->getRepository('\App\Entity\Etudiant');
        $tabEtu = $repoEtu->findAll();
        
        return $this->render('professeur/listEleve.html.twig', [
            'tabEtu' => $tabEtu,
        ]);
    }
}
