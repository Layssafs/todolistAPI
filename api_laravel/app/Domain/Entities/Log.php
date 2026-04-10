<?php

namespace App\Domain\Entities;

use DateTimeInterface;

class Log
{
    private ?int $id;
    private string $acao;
    private ?string $detalhe;
    private ?int $usuarioId;
    private ?DateTimeInterface $timestamp;

    public function __construct(
        string $acao,
        ?string $detalhe = null,
        ?int $usuarioId = null,
        ?DateTimeInterface $timestamp = null,
        ?int $id = null
    ) {
        $this->acao = $acao;
        $this->detalhe = $detalhe;
        $this->usuarioId = $usuarioId;
        $this->timestamp = $timestamp;
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAcao(): string
    {
        return $this->acao;
    }

    public function getDetalhe(): ?string
    {
        return $this->detalhe;
    }

    public function getUsuarioId(): ?int
    {
        return $this->usuarioId;
    }

    public function getTimestamp(): ?DateTimeInterface
    {
        return $this->timestamp;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'acao' => $this->acao,
            'detalhe' => $this->detalhe,
            'usuarioId' => $this->usuarioId,
            'timestamp' => $this->timestamp ? $this->timestamp->format('Y-m-d H:i:s') : null,
        ];
    }
}
