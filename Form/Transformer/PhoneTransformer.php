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

class PhoneTransformer implements DataTransformerInterface
{
    /** @var string $defaultRegion */
    protected $defaultRegion;

    protected $format;

    public function __construct($defaultRegion = 'ES', $format = \libphonenumber\PhoneNumberFormat::INTERNATIONAL)
    {
        $this->defaultRegion = $defaultRegion;
        $this->format = $format;
    }

    /**
     * @param mixed $value
     * @return bool|string
     */
    public function reverseTransform($value)
    {
        if (!$value) {
            return;
        }
        try {
            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
            $phoneNumber = $phoneUtil->parse($value, $this->defaultRegion);

            return $phoneUtil->format($phoneNumber, $this->format);
        } catch (\Exception  $e) {
            return $value;
        }
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
