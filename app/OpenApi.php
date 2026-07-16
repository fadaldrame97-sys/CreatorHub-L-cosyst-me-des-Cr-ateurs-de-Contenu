<?php

namespace App;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "CreatorHub API",
    description: "Documentation de l'API CreatorHub"
)]

#[OA\Server(
    url: "http://localhost:8000",
    description: "Serveur local"
)]

class OpenApi
{
}