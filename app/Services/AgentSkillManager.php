<?php

namespace App\Services;

use App\Contracts\AgentSkillInterface;

class AgentSkillManager
{
    protected array $skills = [];

    public function register(AgentSkillInterface $skill): void
    {
        $this->skills[$skill->getName()] = $skill;
    }

    public function execute(string $name, array $parameters = []): mixed
    {
        if (!isset($this->skills[$name])) {
            throw new \Exception("Skill [{$name}] not found.");
        }

        return $this->skills[$name]->execute($parameters);
    }

    public function all(): array
    {
        return array_keys($this->skills);
    }
}
