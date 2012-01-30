<?php

namespace HotDesign\SimpleCatalogBundle\Entity;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class CategoryRepository extends NestedTreeRepository {

    public function IndentRec(& $node, & $output) {
        foreach ($node as & $rama) {
            if (!isset($rama['title']))
                return; //No tiene sentido una categoria sin nombre.
            $rama['title'] = str_repeat('_', $rama['lvl']) . $rama['title'];
            $output[ $rama['id'] ] = $rama['title'];
            if (!empty($rama['__children'])) {
                $this->IndentRec($rama['__children'], $output);
            }
        }
    }

    public function getIndentedChoicesTree() {


        $arrayTree = $this->childrenHierarchy();


        $out = array();



        $this->IndentRec($arrayTree, $out);
        return $out;
    }

// your code here
}