<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use App\Entity\Ville;
use App\Service\UserService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $upei;

    /**
     * AppFixtures constructor.
     */
    public function __construct(UserPasswordEncoderInterface $upei)
    {
        $this->upei = $upei;
    }

    public function load(ObjectManager $manager)
    {
        $ville = new Ville();
        $ville->setLibelle("perpignan");
        $ville->setCodePostal("66000");
        $manager->persist($ville);

        $utilisateur = new Utilisateur();
        $utilisateur->setCourriel("damien@gmail.com");
        $utilisateur->setMotDePasse($this->upei->encodePassword($utilisateur, "totololo"));
//        dump($utilisateur);
        $manager->persist($utilisateur);
        $manager->flush();
    }
}
