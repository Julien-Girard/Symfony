<?php

namespace App\Controller;

use App\Entity\Theme;
use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Message;
use App\Form\MessageType;

class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="message")
     */
    public function index()
    {
        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
        ]);
    }
    
    /**
     * @Route("/message/add", name="message_add")
     */
    public function add(Request $req)
    {
    	// Construction de la liste des users à envoyer au formulaire
    	$doc = $this->getDoctrine();
    	$man = $doc->getManager();
    	$repoU = $man->getRepository(Utilisateur::class);
    	$listeUsers = $repoU->findAll();
    	//construction de la liste des thèmes
    	$repoT = $man->getRepository('\App\Entity\Theme');
    	$listeThemes = $repoT->findAll();
    	
    	$m = new Message();
    	$m->setDate(new \DateTime());
    	$form = $this->createForm(MessageType::class,$m, ['liste_users'=>$listeUsers, 'liste_themes'=>$listeThemes]);
    	$form->handleRequest($req);
    	if ($form->isSubmitted()) {
    		//traitement données
    		$man->persist($m);
    		$man->flush();
    		
    		//vue
    		$idTheme = $m->getTheme()->getId();
    		$ret = $this->redirectToRoute('listmessage', ['id' => $idTheme]);
    		
    	} else {
    		//formulaire non validé donc affichage formulaire
    		$ret = $this->render('message/add.html.twig', [
    				'form' => $form->createView(),
    		]);
    	}
    	
    	return $ret;
    	
    }
    
    /**
     * @Route("/message/list", name="listmessage")
     */
    public function list()
    {
        $doc = $this->getDoctrine();
        $man = $doc->getManager();
        $repoPers = $man->getRepository('\App\Entity\Message');
        $res = $repoPers->findAll();
        return $this->render('message/list.html.twig', [
            'res' => $res,
        ]);
    }
    
 
}
