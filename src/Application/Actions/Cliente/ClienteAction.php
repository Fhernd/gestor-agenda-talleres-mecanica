<?php

declare(strict_types=1);

namespace App\Application\Actions\Cliente;

use App\Application\Actions\Action;
use App\Domain\Cliente\ClienteRepository;
use Psr\Log\LoggerInterface;

abstract class ClienteAction extends Action
{
    protected ClienteRepository $clienteRepository;

    public function __construct(LoggerInterface $logger, ClienteRepository $clienteRepository)
    {
        parent::__construct($logger);
        $this->clienteRepository = $clienteRepository;
    }
}
