<?php

namespace HotDesign\SimpleCatalogBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ImageAttachmentLimitConstraintValidator extends ConstraintValidator
{
    public function isValid($value, Constraint $constraint)
    {
        if ($value > 10) {
            $this->setMessage($constraint->message);
            return false;
        }

        return true;
    }
}