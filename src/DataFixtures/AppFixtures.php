<?php

namespace App\DataFixtures;

use App\Entity\Facture;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


	/**
	 * @param ObjectManager $manager
	 * @throws Exception
	 */
    public function load(ObjectManager $manager)
    {
      //  dd($this->getDoctrine()->getManager()->getRepository(User::class)->findOneBy(['id'=>2]));
        


        for ($i=0; $i < 5 ; $i++) { 
            $user= new User();
            $user->setName('fisrtname'. $i);
            $user->setLastname('lastname'. $i);
            $user->setEmail('sahibmartial'.$i.'@gmail.com');
            $user->setReference(uniqid());
            $user->setPassword($this->passwordHasher->hashPassword($user,'ubuntu21@'));
            $user->setRoles((['ROLE_ACCESS']));
            $manager->persist($user);


            //update Facture
            for ($j=0; $j < 10 ; $j++) { 
                $facture = new Facture(20);   
                
             //   dd( $facture);
            $facture->setDésignation('Facture'.$i);
            $facture->setDescription('Decription'.$i);
            $facture->setPrixHT(mt_rand(10, 10000));
            $facture->setPrixTTC( round( $facture->getPrixHT() + ( ($facture->getPrixHT() * $facture->getTva()) /100),2 )
        );
            $facture->setEmmetteur($user);
            $manager->persist($facture);
            $user->addFacture($facture);
            }


        }
       //  dd($user->getUserIdentifier());
        
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();
        //creation de 20 factures 
     /*  for ($i = 0; $i < 5; $i++) {
			$facture = new Facture();
			$facture->setDésignation('Facture'.$i);
            $facture->setDescription('Decription'.$i);
            $facture->setPrixHT(mt_rand(10, 100));
            $facture->setPrixTTC(mt_rand(10, 100));
          //  $facture->setEmmetteur($user);
          // dd($facture);
			$manager->persist($facture);
            //add facture to user

		} */
       // $user = new User();

        $manager->flush();
    }
}
