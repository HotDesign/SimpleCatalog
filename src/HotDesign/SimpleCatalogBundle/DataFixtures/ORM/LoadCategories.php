<?php

namespace HotDesign\SimpleCatalogBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use HotDesign\SimpleCatalogBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCategories extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }

    public function load(ObjectManager $manager) {

        for ($i = 0; $i < 5; $i++) {
            $c = 'category'.$i;
            $$c = new Category();
            $$c->setTitle('Categoria '.$i);
            $$c->setDescription('Categoría '.$i.' description');

            $this->addReference('category'.$i, $$c);
            $manager->persist($$c);
        }

        $manager->flush();
    }

}