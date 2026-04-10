<?php

namespace App\UseCases\Logs;

use App\Domain\Entities\Log;
use App\Domain\Repositories\LogRepositoryInterface;

class CreateLogUseCase
{
    private LogRepositoryInterface $logRepository;

    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    public function execute(string $acao, ?string $detalhe = null, ?int $usuarioId = null): Log
    {
        // Data validations or business logic before logging
        // Since we want to let the database handle timestamp if not provided, 
        // Or we can set it now.
        $log = new Log($acao, $detalhe, $usuarioId, new \DateTimeImmutable());
        
        return $this->logRepository->save($log);
    }
}
