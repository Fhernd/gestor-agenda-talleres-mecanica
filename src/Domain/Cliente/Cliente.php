<?php

declare(strict_types=1);

namespace App\Domain\Cliente;

use JsonSerializable;

class Cliente implements JsonSerializable
{
    private string $id;
    private string $documento;
    private string $nombreCompleto;
    private ?string $telefono;
    private ?string $correo;
    private ?string $direccion;

    public function __construct(
        string $id,
        string $documento,
        string $nombreCompleto,
        ?string $telefono,
        ?string $correo,
        ?string $direccion
    ) {
        $this->id = $id;
        $this->documento = $documento;
        $this->nombreCompleto = $nombreCompleto;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->direccion = $direccion;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDocumento(): string
    {
        return $this->documento;
    }

    public function getNombreCompleto(): string
    {
        return $this->nombreCompleto;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'documento' => $this->documento,
            'nombre_completo' => $this->nombreCompleto,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
            'direccion' => $this->direccion,
        ];
    }
}
