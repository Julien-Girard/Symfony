<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class JeproController extends AbstractController
{
    /**
     * @Route("/jepro", name="testt")
     */
    public function test()
    {
        return $this->render('jepro/index.html.twig',[
            'page_name' => 'Profil',
            'nom' => "Girard",
            'prenom' => "Julien"
        ]);
    }
}
