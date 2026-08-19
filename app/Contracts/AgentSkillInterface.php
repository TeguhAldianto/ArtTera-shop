<?php

namespace App\Contracts;

interface AgentSkillInterface
{
    public function getName(): string;

    public function execute(array $parameters): mixed;
}
