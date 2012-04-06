<?php

namespace HotDesign\SimpleCatalogBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use HotDesign\SimpleCatalogBundle\Entity\Category;
use HotDesign\SimpleCatalogBundle\Entity\BaseEntity;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadItems extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3;
    }

    public function load(ObjectManager $manager) {

        $category0 = $this->getReference('category0');
        $category1 = $this->getReference('category1');
        $category2 = $this->getReference('category2');
        $category3 = $this->getReference('category3');
        $category4 = $this->getReference('category4');

        for ($i = 0; $i < 20; $i++) {
            $item = 'item'.$i;
            $$item = new BaseEntity();
            $$item->setTitle('Item '.$i);
            $$item->setDescription('Item '.$i.' description');
            switch ($i) {
                case ($i < 4):
                    $$item->setCategory($category0);
                    break;
                case ($i < 8):
                    $$item->setCategory($category1);
                    break;
                case ($i < 12):
                    $$item->setCategory($category2);
                    break;
                case ($i < 16):
                    $$item->setCategory($category3);
                    break;
                case ($i < 20):
                    $$item->setCategory($category4);
                    break;
                default:
                    $$item->setCategory($category0);
                    break;
            }
            $manager->persist($$item);
        }

        $manager->flush();
    }

}