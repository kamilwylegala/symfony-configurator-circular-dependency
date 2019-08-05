# Symfony configurator circular dependency

Example code that shows issue with reporting circular dependency problem when configurator mechanism is used to manage services in container.

## How to run?

Install dependencies via composer and then run:

### Configurator

```
$ php configurator.php
```

It will setup services container where `Entity` object is configured and enriched with validator via configurator.

Output will be:
```
Creating entity instance.
Configuring entity.
I'm validating entity
... (infinite loop of validation)
I'm validating entity
PHP Fatal error:  Uncaught Error: Maximum function nesting level of '256' reached, aborting! in /home/kamil/workspace/configurator-circular-dependency/src/Services/EntityValidator.php:16
Stack trace:
#0 /home/kamil/workspace/configurator-circular-dependency/src/Services/Entity.php(23): Services\EntityValidator->validate()
#1 /home/kamil/workspace/configurator-circular-dependency/src/Services/EntityValidator.php(19): Services\Entity->validate()
#2 /home/kamil/workspace/configurator-circular-dependency/src/Services/Entity.php(23): Services\EntityValidator->validate()
#3 /home/kamil/workspace/configurator-circular-dependency/src/Services/EntityValidator.php(19): Services\Entity->validate()
#4 /home/kamil/workspace/configurator-circular-dependency/src/Services/Entity.php(23): Services\EntityValidator->validate()
#5 /home/kamil/workspace/configurator-circular-dependency/src/Services/EntityValidator.php(19): Services\Entity->validate()
#6 /home/kamil/workspace/configurator-circular-dependency/src/Services/Entity.php(23): Services\En in /home/kamil/workspace/configurator-circular-dependency/src/Services/EntityValidator.php on line 16
```

### Factory

```
$ php factory.php 
```

There is factory mechanism used to prepare `Entity` object. You can see below it ends up with fatal error.

Output will be:
```
PHP Fatal error:  Uncaught Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException: Circular reference detected for service "Services\EntityFactory", path: "Services\EntityFactory -> Services\EntityValidator -> Services\Entity -> Services\EntityFactory". in /home/kamil/workspace/configurator-circular-dependency/vendor/symfony/dependency-injection/Compiler/CheckCircularReferencesPass.php:67
Stack trace:
#0 /home/kamil/workspace/configurator-circular-dependency/vendor/symfony/dependency-injection/Compiler/CheckCircularReferencesPass.php(70): Symfony\Component\DependencyInjection\Compiler\CheckCircularReferencesPass->checkOutEdges(Array)
#1 /home/kamil/workspace/configurator-circular-dependency/vendor/symfony/dependency-injection/Compiler/CheckCircularReferencesPass.php(70): Symfony\Component\DependencyInjection\Compiler\CheckCircularReferencesPass->checkOutEdges(Array)
#2 /home/kamil/workspace/configurator-circular-dependency/vendor/symfony/dependency-injection/Compiler/CheckCircularReferencesPass.php(4 in /home/kamil/workspace/configurator-circular-dependency/vendor/symfony/dependency-injection/Compiler/CheckCircularReferencesPass.php on line 67
```