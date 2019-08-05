<?php

namespace Services;


class EntityConfigurator
{
    /** @var EntityValidator */
    private $entityValidator;

    public function __construct(EntityValidator $entityValidator)
    {
        $this->entityValidator = $entityValidator;
    }

    public function configure(Entity $entity)
    {
        echo "Configuring entity.\n";
        $entity->setValidator($this->entityValidator);
    }

}