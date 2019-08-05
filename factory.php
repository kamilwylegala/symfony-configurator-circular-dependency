<?php
require __DIR__ . "/vendor/autoload.php";

use Services\Entity;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;


$containerBuilder = new ContainerBuilder();
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));

$loader->load("services_factory.yml");

$containerBuilder->compile();

/** @var Entity $entity */
$entity = $containerBuilder->get(Entity::class);
$entity->validate();