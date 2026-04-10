<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\LogModel;

class LogServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_task_log_without_auth()
    {
        $payload = [
            'acao' => 'Tarefa Concluída',
            'detalhe' => 'Finalizada com sucesso',
            'usuarioId' => 123
        ];

        $response = $this->postJson('/api/logs', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'acao' => 'Tarefa Concluída',
                     'detalhe' => 'Finalizada com sucesso',
                     'usuarioId' => 123
                 ]);

        $this->assertDatabaseHas('logs', [
            'acao' => 'Tarefa Concluída',
            'detalhe' => 'Finalizada com sucesso',
            'usuario_id' => 123
        ]);
    }

    public function test_can_list_logs_by_usuario_id()
    {
        LogModel::create([
            'acao' => 'Criação',
            'usuario_id' => 1,
            'timestamp' => now()->subDay()
        ]);
        LogModel::create([
            'acao' => 'Conclusão',
            'usuario_id' => 2,
            'timestamp' => now()
        ]);

        $response = $this->getJson('/api/logs?usuarioId=1');

        $response->assertStatus(200)
                 ->assertJsonCount(1);
                 
        $response->assertJsonFragment([
            'usuarioId' => 1,
            'acao' => 'Criação'
        ]);
    }
}
