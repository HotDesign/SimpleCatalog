<?php

namespace HotDesign\SimpleCatalogBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use HotDesign\SimpleCatalogBundle\Entity\BaseEntity;
use HotDesign\SimpleCatalogBundle\Config\Currencies;

class BaseEntityListener {

    public function postPersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        //$entityManager = $args->getEntityManager();

        if ($entity instanceof BaseEntity) {
            if ($entity->getIsBillable() && $entity->getPrice() && $entity->getCurrency()) {

                $price_to_uss = $entity->getPrice() * Currencies::getCurrencyIndex($entity->getCurrency());

                if (!empty($price_to_uss) && is_numeric($price_to_uss)) {
                    $entity->setPriceToUss($price_to_uss);
                }
            }
        }
    }

}