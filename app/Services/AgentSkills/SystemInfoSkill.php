<?php

namespace App\Services\AgentSkills;

use App\Contracts\AgentSkillInterface;

class SystemInfoSkill implements AgentSkillInterface
{
    public function getName(): string
    {
        return 'system_info';
    }

    public function execute(array $parameters): mixed
    {
        return [
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'time' => now()->toIso8601String(),
        ];
    }
}
