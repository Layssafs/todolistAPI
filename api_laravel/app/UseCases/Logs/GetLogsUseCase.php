<?php

namespace App\UseCases\Logs;

use App\Domain\Entities\Log;
use App\Domain\Repositories\LogRepositoryInterface;

class GetLogsUseCase
{
    private LogRepositoryInterface $logRepository;

    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    /**
     * @return array<Log>
     */
    public function execute(?int $usuarioId = null): array
    {
        return $this->logRepository->findAll($usuarioId);
    }
}
