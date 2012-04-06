<?php

namespace HotDesign\SimpleCatalogBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ImageAttachmentLimitConstraint extends Constraint
{
    public $message = 'No es posible cargar más de 10 imágenes';

    public function validatedBy()
    {
        return 'image_attachment_limit_constraint_validator';
    }
}
