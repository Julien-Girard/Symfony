<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    /**
     * @Route("/user/add", name="adduser")
     */
    public function index()
    {
        $form = $this->createForm(UserType::class,null,[
            'action' => '/user/added'
        ]);
        $response = $this->render('user/add.html.twig', [
            'formulaire' => $form->createView(),
        ]);
        return $response;
    }
    
    /**
     * @Route("/user/added", name="addeduser")
     */
    public function add(Request $req)
    {
        $new = new Utilisateur();
        $form = $this->createForm(UserType::class,$new);
        $form->handleRequest($req);
        $new->setDate(new \DateTime());
        
        $doct = $this->getDoctrine();
        $man = $doct->getManager();
        $man->persist($new);
        $man->flush();
        
        return $this->redirectToRoute('listuser');
    }
    
    /**
     * @Route("/user/list", name="listuser")
     */
    public function list()
    {
        $doc = $this->getDoctrine();
        $man = $doc->getManager();
        $repoPers = $man->getRepository('\App\Entity\Role');
        $res = $repoPers->findAll();
        
        $docUser = $this->getDoctrine();
        $manUser = $docUser->getManager();
        $repoPersUser = $manUser->getRepository('\App\Entity\Utilisateur');
        $resUser = $repoPersUser->findAll();
        
        return $this->render('user/list.html.twig', [
            'resUser' => $resUser,
            'res' => $res,
        ]);
    }
    
    /**
     * @Route("/user/delete/{id}", name="deleteuser")
     */
    public function delete($id)
    {
        $form = $this->createForm(UserType::class,null);
        
        $doct = $this->getDoctrine();
        $man = $doct->getManager();
        $repoPers = $man->getRepository('\App\Entity\Utilisateur');
        $res = $repoPers->findBy(['id'=>$id]);
        $man->remove($res[0]);
        $man->flush();
        
        return $this->redirectToRoute('listuser');
    }

    /**
     * @Route("/user/update/{id}", name="updateuser")
     */
    public function update($id){
        $doc = $this->getDoctrine();
        $man = $doc->getManager();
        $repoPers = $man->getRepository('\App\Entity\Utilisateur');
        $tab = $repoPers->findBy(['id'=>$id]);
        
        $form = $this->createForm(UserType::class,$tab[0],[
            'method' => 'POST',
            'action' => '/user/updated/'.$id
        ]);
        
        return $this->render('user/update.html.twig', ['formulaire' => $form->createView(),]);
    }
    /**
     * @Route("/user/updated/{id}", name="updateduser")
     */
    public function updated(Request $req,$id){
        $doc = $this->getDoctrine();
        $man = $doc->getManager();
        $repoPers = $man->getRepository('\App\Entity\Utilisateur');
        $tab = $repoPers->findBy(['id'=>$id]);
        
        $form = $this->createForm(UserType::class,$tab[0]);
        $form->handleRequest($req);
        $doct = $this->getDoctrine();
        $man = $doct->getManager();
        $man->persist($tab[0]);
        $man->flush();
        
        return $this->redirectToRoute('listuser');
    }
    
}
