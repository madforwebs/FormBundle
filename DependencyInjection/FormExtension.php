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

namespace MadForWebs\FormBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Finder\Finder;

class FormExtension extends Extension
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $servicesDirectory = __DIR__.'/../Resources/config';
        $finder = new Finder();
        $loader = new YamlFileLoader($container, new FileLocator($servicesDirectory));
        $finder->in($servicesDirectory);
        $files = $finder->name('*.yml')->files();
        foreach ($files as $file) {
            $loader->load($file->getFilename());
        }
    }
}
