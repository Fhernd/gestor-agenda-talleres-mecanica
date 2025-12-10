<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Cliente;

use App\Domain\Cliente\Cliente;
use App\Domain\Cliente\ClienteNotFoundException;
use App\Domain\Cliente\ClienteRepository;
use PDO;

class PDOClienteRepository implements ClienteRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        $stmt = $this->connection->query('SELECT * FROM cliente');
        $results = $stmt->fetchAll();

        return array_map(function ($row) {
            return $this->mapRowToCliente($row);
        }, $results);
    }

    /**
     * {@inheritdoc}
     */
    public function findClienteOfId(string $id): Cliente
    {
        $stmt = $this->connection->prepare('SELECT * FROM cliente WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) {
            throw new ClienteNotFoundException();
        }

        return $this->mapRowToCliente($row);
    }

    private function mapRowToCliente(array $row): Cliente
    {
        return new Cliente(
            $row['id'],
            $row['documento'],
            $row['nombre_completo'],
            $row['telefono'] ?? null,
            $row['correo'] ?? null,
            $row['direccion'] ?? null
        );
    }
}
