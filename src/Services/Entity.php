<?php

namespace Services;

class Entity
{

    /** @var EntityValidator */
    private $validator;

    public function __construct()
    {
        echo "Creating entity instance.\n";
    }

    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    public function validate()
    {
        $this->validator->validate();
    }

}