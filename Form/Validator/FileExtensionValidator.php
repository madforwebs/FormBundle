<?php

/*
 * This file is part of the MadForWebs package
 *
 * Copyright (c) 2017 Fernando Sánchez Martínez
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Fernando Sánchez <fer@madforwebs.com>
 */

namespace MadForWebs\FormBundle\Form\Validator;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\FileValidator;

class FileExtensionValidator extends FileValidator
{
    /**
     * @param                                         $value
     * @param \Symfony\Component\Validator\Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        parent::validate($value, $constraint);
        if (!$value) {
            return;
        }
        $extension = $value->getClientOriginalExtension();
        if (!count($constraint->fileExtensions)) {
            return;
        }
        if (!in_array($extension, $constraint->fileExtensions)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
