<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'acao' => 'required|string',
            'detalhe' => 'nullable|string',
            'usuarioId' => 'nullable|integer',
        ]);

        $log = Log::create([
            'acao' => $request->acao,
            'detalhe' => $request->detalhe,
            'usuario_id' => $request->usuarioId,
            'timestamp' => now(),
        ]);

        return response()->json($log, 201);
    }

    public function index(Request $request)
    {
        $logs = Log::when($request->usuarioId, function ($query) use ($request) {
                return $query->where('usuario_id', $request->usuarioId);
            })
            ->orderBy('timestamp', 'desc')
            ->get();

        return response()->json($logs);
    }
}
