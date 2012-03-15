<?php

namespace HotDesign\ScUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ScUserBundle extends Bundle {

    public function getParent() {
        return 'FOSUserBundle';
    }

}
