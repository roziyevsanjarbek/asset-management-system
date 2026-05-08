<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    description: 'API documentation for Asset Management System',
    title: 'Asset Management System API'
)]

#[OA\Server(
    url: 'http://127.0.0.1:8000',
    description: 'Local Server'
)]

#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    bearerFormat: 'JWT',
    scheme: 'bearer'
)]

class OpenApiSpec
{
}
