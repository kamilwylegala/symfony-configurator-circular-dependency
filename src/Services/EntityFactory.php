<?php

namespace Services;

class EntityFactory
{

    /** @var EntityValidator */
    private $entityValidator;

    public function __construct(EntityValidator $entityValidator)
    {
        $this->entityValidator = $entityValidator;
    }

    public function createEntity(): Entity
    {
        echo "Creating entity via factory\n";
        $entity = new Entity();
        $entity->setValidator($this->entityValidator);
        return $entity;
    }
}