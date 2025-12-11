<?php

declare(strict_types=1);

namespace App\Application\Actions\Cliente;

use Psr\Http\Message\ResponseInterface as Response;

class ViewClienteAction extends ClienteAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $observacionId = (string) $this->resolveArg('id');
        $cliente = $this->clienteRepository->findClienteOfId($observacionId);

        $this->logger->info("Cliente of id {$observacionId} was viewed.");

        return $this->respondWithData($cliente);
    }
}
