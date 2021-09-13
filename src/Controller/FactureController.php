<?php

namespace App\Controller;

use App\Entity\Facture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FactureController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }
    /**
     * @Route("/facture", name="facture")
     */
    public function index(): Response
    {
        $notification="";

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user=$this->getUser()->getLastname();

        try {
            $factures=$this->entityManager->getRepository(Facture::class)->findAll();
        } catch (\Throwable $th) {
            throw $th;
        }


        return $this->render('facture/index.html.twig', [
            'controller_name' => 'Vos Factures',
            'user'=>$user,
            'factures'=> $factures
        ]);
    }
    

    /**
     * @Route("/facture/ajouter", name="facture_add")
     */
    public function ajouterFacture(Request $request)
    {

        $notification="";

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user=$this->getUser()->getLastname();


        return $this->render('facture/ajouter.html.twig', [
            'controller_name' => 'Créer une facture',
            'user'=>$user
        ]);

    }

     /**
     * @Route("/facture/edit/{id}", name="facture_edit")
     */

    public function editerFacture($id)
    {

        $notification="";

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user=$this->getUser()->getLastname();


        return $this->render('facture/edit.html.twig', [
            'controller_name' => 'Editer facture n°:',
            'user'=>$user
        ]);
    }


     /**
     * @Route("/facture/supprime/{id}", name="facture_supprimer")
     */

    public function supprimerFacture($id)
    {
        $notification="";

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user=$this->getUser()->getLastname();


        return $this->render('facture/supprime.html.twig', [
            'controller_name' => 'Editer facture n°:',
            'user'=>$user
        ]);
    }



     /**
     * @Route("/facture/suppression/", name="facture_suppression")
     */
    public function confirmeSuppressionfacture()
    {
        $notification="";

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user=$this->getUser()->getLastname();


        return $this->render('facture/suppression.html.twig', [
            'controller_name' => 'Editer facture n°:',
            'user'=>$user
        ]);
    }

}
