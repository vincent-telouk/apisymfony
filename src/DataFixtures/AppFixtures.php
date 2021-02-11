<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();

        for( $u=0; $u<10;$u++){
            $user = new User();
            $passHash = $this->encoder->encodePassword($user, 'password');
            $user->setEmail($faker->email)
                ->setPassword($passHash);
            $manager->persist($user);
            for ($a=0; $a < random_int(5, 20); $a++){
                $article = (new Article())->setAuthor($user)
                    ->setContent($faker->text(300))
                    ->setName($faker->text(30));
                $manager->persist($article);
            }
        }

        $manager->flush();
       

        $manager->flush();
    }
}
