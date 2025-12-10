<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('¡Hola, mundo!');
        return $response;
    });

    $app->get('/saludo', function (Request $request, Response $response) {
        $params = $request->getQueryParams();
        $nombre = $params['nombre'] ?? 'Desconocido';
        $response->getBody()->write("Hola, $nombre");
        return $response;
    });

    $app->get('/random-users', function (Request $request, Response $response) {
        $data = file_get_contents('https://randomuser.me/api?results=5');
        $users = json_decode($data, true);

        $filteredUsers = array_map(function ($user) {
            return [
                'Nombre completo' => $user['name']['first'] . ' ' . $user['name']['last'],
                'Género' => $user['gender'],
                'Email' => $user['email'],
                'Zona horaria' => $user['location']['timezone']['description'] ?? 'No disponible',
            ];
        }, $users['results']);

        $response->getBody()->write(json_encode($filteredUsers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
};
