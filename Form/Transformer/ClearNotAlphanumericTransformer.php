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

namespace MadForWebs\FormBundle\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;

class ClearNotAlphanumericTransformer implements DataTransformerInterface
{
    /**
     * @param string $number
     *
     * @return string
     */
    public function reverseTransform($number)
    {
        return preg_replace("/[^\d\w]/", "", $number);
    }

    /**
     * @param string $number
     *
     * @return string
     */
    public function transform($number)
    {
        if (null === $number) {
            return '';
        }

        return $number;
    }
}
