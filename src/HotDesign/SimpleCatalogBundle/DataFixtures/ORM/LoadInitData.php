<?php

namespace HotDesign\SimpleCatalogBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

use HotDesign\SimpleCatalogBundle\Entity\Category;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {


        //Primero cargamos Categorias
        $c = new Category();

        $c->setTitle('Categorías Base');
        $c->setDescription('Categoría Padre de Todas');

        $manager->persist($c);
        $manager->flush();
    }

}