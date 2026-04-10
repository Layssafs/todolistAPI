<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLogRequest;
use App\UseCases\Logs\CreateLogUseCase;
use App\UseCases\Logs\GetLogsUseCase;
use Illuminate\Http\Request;

class LogController extends Controller
{
    private CreateLogUseCase $createLogUseCase;
    private GetLogsUseCase $getLogsUseCase;

    public function __construct(CreateLogUseCase $createLogUseCase, GetLogsUseCase $getLogsUseCase)
    {
        $this->createLogUseCase = $createLogUseCase;
        $this->getLogsUseCase = $getLogsUseCase;
    }

    public function store(StoreLogRequest $request)
    {
        $validated = $request->validated();

        $log = $this->createLogUseCase->execute(
            $validated['acao'],
            $validated['detalhe'] ?? null,
            $validated['usuarioId'] ?? null
        );

        return response()->json($log->toArray(), 201);
    }

    public function index(Request $request)
    {
        $usuarioId = $request->get('usuarioId');
        
        $logs = $this->getLogsUseCase->execute($usuarioId ? (int)$usuarioId : null);
        
        $logsArray = array_map(function($log) {
            return $log->toArray();
        }, $logs);

        return response()->json($logsArray);
    }
}
