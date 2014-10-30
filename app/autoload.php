<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__ . '/../vendor/autoload.php';

//$loader->add('Guzzle', __DIR__ . '/../vendor/guzzle/src');
//$loader->add('Ddeboer', __DIR__ . '/../vendor/bundles');
$loader->add('Slik', __DIR__ . '/../vendor/bundles');
// activate the autoloader
$loader->register();

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;