<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Log;
use App\Domain\Repositories\LogRepositoryInterface;
use App\Models\LogModel;
use DateTime;

class EloquentLogRepository implements LogRepositoryInterface
{
    public function save(Log $log): Log
    {
        $logModel = new LogModel();
        
        $logModel->acao = $log->getAcao();
        $logModel->detalhe = $log->getDetalhe();
        $logModel->usuario_id = $log->getUsuarioId();
        
        if ($log->getTimestamp() !== null) {
            $logModel->timestamp = $log->getTimestamp();
        }

        $logModel->save();

        return new Log(
            $logModel->acao,
            $logModel->detalhe,
            $logModel->usuario_id,
            $logModel->timestamp,
            $logModel->id
        );
    }

    public function findAll(?int $usuarioId = null): array
    {
        $query = LogModel::query();
        
        if ($usuarioId !== null) {
            $query->where('usuario_id', $usuarioId);
        }

        $query->orderBy('timestamp', 'desc');

        $logModels = $query->get();
        
        $logs = [];
        foreach ($logModels as $model) {
            $logs[] = new Log(
                $model->acao,
                $model->detalhe,
                $model->usuario_id,
                $model->timestamp,
                $model->id
            );
        }

        return $logs;
    }
}
