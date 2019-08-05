<?php

namespace Services;


class EntityValidator
{
    /** @var Entity */
    private $entity;

    public function __construct(Entity $entity)
    {
        $this->entity = $entity;
    }

    public function validate()
    {
        echo "I'm validating entity\n";
        $this->entity->validate();
    }

}