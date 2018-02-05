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

use JBBCode\Parser;
use Symfony\Component\Form\DataTransformerInterface;

class BBcodeTransformer implements DataTransformerInterface
{

    /** @var Parser */
    protected $parser;

    /**
     * @param $parser
     */
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param string $number
     *
     * @return string
     */
    public function transform($text)
    {
        if (null === $text) {
            return '';
        }

        return $text;
    }

    /**
     * @param string $number
     *
     * @return string
     */
    public function reverseTransform($text)
    {
        $this->parser->parse($text);
        $html = $this->parser->getAsHTML();

        dump($html);
        $url = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';

        return preg_replace($url, '<a href="http$2://$4" target="_blank" rel="nofollow" title="$0">$0</a>', $html);
    }
}
