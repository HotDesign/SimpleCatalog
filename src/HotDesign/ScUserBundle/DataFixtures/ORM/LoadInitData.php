<?php

namespace HotDesign\ScUserBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use HotDesign\SimpleCatalogBundle\Entity\Category;
use HotDesign\ScUserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }


    public function load(ObjectManager $manager) {


        //Primero cargamos Categorias
        // $c = new Category();

        // $c->setTitle('Categorías Base');
        // $c->setDescription('Categoría Padre de Todas');

        // $manager->persist($c);



        $user = new User();

        //get list of fields for User
        $user->setUsername('admin');
        $user->setEmail('info@hotdesign.com.ar');
        $user->setPlainPassword('admin');
        $user->addRole('ROLE_ADMIN');
        $user->setEnabled(true);

//        $user->setBidsLeft('25');
//        $user->setAlgorithm('sha512');

        $manager->persist($user);
        
        
                $user = new User();

        //get list of fields for User
        $user->setUsername('user');
        $user->setEmail('infouser@hotdesign.com.ar');
        $user->setPlainPassword('user');
        $user->addRole('ROLE_USER');
        $user->setEnabled(true);

//        $user->setBidsLeft('25');
//        $user->setAlgorithm('sha512');

        $manager->persist($user);

        $manager->flush();
    }

}