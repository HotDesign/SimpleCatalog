<?php

namespace HotDesign\SimpleCatalogBundle\Validator;

use HotDesign\SimpleCatalogBundle\Config\MyConfig;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ImageAttachmentLimitConstraint extends Constraint
{
    public $message = 'Usted ha superado el límite de imágenes por Item asignado.';

    public function validatedBy()
    {
        return 'image_attachment_limit_constraint_validator';
    }
}
