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

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Yaml\Yaml;

class YmlFileValidator extends ConstraintValidator
{
    /**
     * @var \Symfony\Component\Validator\Context\ExecutionContextInterface
     */
    protected $context;

    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        try {
            $data = Yaml::parse($value, 2);
            if (!is_array($data)) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();

                return;
            }

            $allowedKeys = ['runcmd', 'yum_repos', 'packages', 'write_files'];

            foreach ($data as $key => $value) {
                if (!in_array($key, $allowedKeys)) {
                    $this->context->buildViolation(
                        sprintf('clave "%s" no valida. Aceptadas %s', $key, implode($allowedKeys, ', '))
                    )
                        ->addViolation();
                }
            }
        } catch (\Exception $e) {
            $this->context->buildViolation($e->getMessage())
                ->addViolation();
        }
    }
}
