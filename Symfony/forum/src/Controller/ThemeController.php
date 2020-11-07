<?php

namespace App\Controller;

use App\Form\ThemeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Theme;
use PhpParser\Node\Stmt\Foreach_;
use Symfony\Bundle\FrameworkBundle\Client;

class ThemeController extends AbstractController
{
    /**
     * @Route("/theme/add", name="addtheme")
     */
    public function add()
    {
        $doc = $this->getDoctrine();
        $man = $doc->getManager();
        $repoPers = $man->getRepository('\App\Entity\Utilisateur');
        $res = $repoPers->findAll();
        
        $form = $this->createForm(ThemeType::class,null,[
            'action' => '/theme/added',
            'trim' => $res
        ]);
        $response = $this->render('theme/add.html.twig', [
            'formulaire' => $form->createView(),
        ]);
        return $response;
    }
    
    /**
     * @Route("/theme/added", name="addedtheme")
     */
    public function added(Request $req)
    {
        $new = new Theme();
        $form = $this->createForm(ThemeType::class,$new);
        $form->handleRequest($req);
        $new->setDate(new \DateTime());
        
        $tab = $req->get('theme');
        $fdp = $tab['createur'];
        $doct = $this->getDoctrine();
        $man = $doct->getManager();
        $repoPers = $man->getRepository('\App\Entity\Utilisateur');
        $res = $repoPers->findBy(['id'=>$fdp]);
        $new->setCreateur($res[0]);
        
        $doct = $this->getDoctrine();
        $man = $doct->getManager();
        $man->persist($new);
        $man->flush();
        
        return $this->redirectToRoute('listtheme');
    }
    
    /**
     * @Route("/theme/list", name="listtheme")
     */
    public function list()
    {
        $doc = $this->getDoctrine();
        $man = $doc->getManager();
        $repoPers = $man->getRepository('\App\Entity\Theme');
        $repoMessage = $man->getRepository('\App\Entity\Message');
        $res = $repoPers->findAll();
        
        $repoMessage = $man->getRepository('\App\Entity\Message');
        foreach ($res as $t) {
            $message[$t->getId()] = $repoMessage->findLastMessageFromTheme($t);
        }
        return $this->render('theme/list.html.twig', [
            'res' => $res,
            'message' => $message,
        ]);
    }
    
    /**
     * @Route("/theme/last", name="lasttheme")
     */
    public function last()
    {
        $doc = $this->getDoctrine();
        $man = $doc->getManager();
        $repoTheme = $man->getRepository('\App\Entity\Theme');
        $res = $repoTheme->findAll(); //select * from theme;
        
        $repoMessage = $man->getRepository('\App\Entity\Message');
        foreach ($res as $t) {
            $message[$t->getId()] = $repoMessage->findOneBy(['theme'=>$t],['date'=>'DESC']);
        }
        
        return $this->render('theme/last.html.twig', [
            'res' => $res,
            'message' => $message,
        ]);
        //select * from theme order by date desc;
    }
    
    /**
     * @Route("/theme/findlast/", name="findlasttheme")
     */
    public function findLast()
    {
        $doc = $this->getDoctrine();
        $man = $doc->getManager();
        $repoTheme = $man->getRepository('\App\Entity\Theme');
        $res = $repoTheme->findAll(); //select * from theme;
        
        $repoMessage = $man->getRepository('\App\Entity\Message');
        foreach ($res as $t) {
            $message[$t->getId()] = $repoMessage->findLastMessageFromTheme($t); 
        }
        
        return $this->render('theme/last.html.twig', [
            'res' => $res,
            'message' => $message,
        ]);
        //select * from theme order by date desc;
    }
}
