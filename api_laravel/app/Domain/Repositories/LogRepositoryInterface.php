<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Log;

interface LogRepositoryInterface
{
    public function save(Log $log): Log;
    
    /**
     * @return array<Log>
     */
    public function findAll(?int $usuarioId = null): array;
}
