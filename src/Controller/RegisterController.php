<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{


    private $entityManager;
     public function __construct(EntityManagerInterface $entityManager)
     {
         $this->entityManager=$entityManager;
     }


    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request): Response
    {
        $notofication="";
        $user = new User;

       $form=$this->createForm(UserType::class,$user);

       $form->handleRequest( $request);

       if($form->isSubmitted() && $form->isValid())
       {
       // dd($user->getEmail());
           $search= $this->entityManager->getRepository(User::class)->findOneBy(['email'=>$user->getEmail()]);
           if (!$search) {
            $reference= uniqid();
            $user->setReference($reference);

            //step encode password 

            $password=$user->getPassword();
           // dd($password);

           $options = [
            'cost' => 12,
           ];
            $passwencode= password_hash($user->getPassword(), PASSWORD_BCRYPT, $options);
        //  dd($password,$passwencode);

             $user->setPassword($passwencode);
            $this->entityManager->persist($user);

            $this->entityManager->flush();

            $notofication="Inscription validée avec success";

            $user = new User;

           $form=$this->createForm(UserType::class,$user);


           }else{
            $notofication="Inscription impossible Email déjà utilisé, merci";
           }
          
       }

        return $this->render('register/index.html.twig', [
            'controller_name' => 'Inscription',
            'form'=>$form->createView(),
            'notification'=>$notofication
        ]);
    }
}
