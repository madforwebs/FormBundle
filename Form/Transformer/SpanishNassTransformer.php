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

class SpanishNassTransformer implements DataTransformerInterface
{
    /**
     * @param mixed $nass
     * @return bool|string
     */
    public function reverseTransform($value)
    {
        if (null === $value || '' === $value) {
            return;
        }
        $nass = preg_replace('[\D]', '', $value);
        $province = substr($nass, 0, 2);
        $number = substr($nass, 2, 8);
        $control = substr($nass, 10, 2);

        return sprintf('%s/%s/%s', $province, $number, $control);
    }

    /**
     * @param mixed $number
     * @return mixed|string
     */
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        return $value;
    }
}
