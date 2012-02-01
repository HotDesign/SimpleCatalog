<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class CategoryRepository extends NestedTreeRepository {

    public function IndentRec(& $node, & $output) {
        foreach ($node as & $rama) {
            if (!isset($rama['title']))
                return; //No tiene sentido una categoria sin nombre.
            $rama['title'] = str_repeat('_', $rama['lvl']) . $rama['title'];
            $output[] = $rama;
            if (!empty($rama['__children'])) {
                $this->IndentRec($rama['__children'], $output);
            }
        }
    }

    public function getIndentedChoicesTree() {
        $entities = $this->findBy(array(), array('lft' => 'ASC'));
        foreach ($entities as & $entity) {
            $entity->setTitle(\str_repeat('_', $entity->getLvl() . $entity->getTitle() ));
        }
        return $entities;
    }

// your code here
}