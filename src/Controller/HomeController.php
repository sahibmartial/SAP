<?php

namespace App\Controller;

use App\Entity\Facture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user=$this->getUser()->getLastname();

       // dd($user);

        try {
            $factures=$this->entityManager->getRepository(Facture::class)
            //->findAll();
           // dd( $factures);
            ->findByExampleField($this->getUser()->getId());
        } catch (\Throwable $th) {
            throw $th;
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'Liste des factures',
            'user'=> $user,
            'factures'=>$factures
        ]);
    }
}
