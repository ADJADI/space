<?php

use Knuckles\Scribe\Extracting\Strategies;

return [
    // The HTML <title> for the generated documentation.
    'title' => 'API Space Tourism',

    // The base URL to be used in examples and the Postman collection.
    'base_url' => env('APP_URL', 'https://space-production-0b86.up.railway.app'),

    'routes' => [
        [
            'match' => [
                'prefixes' => ['api/*'],
                'domains' => ['*'],
            ],
            'include' => ['*'],
            'exclude' => [],
            'apply' => [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'response_calls' => [
                    'methods' => [], // Désactivé les appels de réponse
                ],
            ],
        ],
    ],

    'postman' => [
        'enabled' => true,
        'overrides' => [
            'info.version' => '1.0.0',
        ],
    ],

    'type' => 'static',
    'static' => [
        'output_path' => 'public/docs',
    ],

    'endpoints' => [
        'router' => 'laravel',
        'bindings' => [
            'id' => 'id',
        ],
        'response_calls' => [
            'env' => 'documentation',
            'methods' => [], // Désactivé les appels de réponse
            'queryParams' => [],
            'bodyParams' => [],
            'fileParams' => [],
        ],
    ],

    'example_values' => [
        'id' => 1,
        'name' => 'Example name',
        'description' => 'Example description for a destination, crew member or technology',
        'image' => '/images/destination/moon.png',
        'travel_time' => '3 days',
        'distance' => '384,400 km',
    ],

    'auth' => [
        'enabled' => false,
    ],

    'strategies' => [
        'metadata' => [
            Strategies\Metadata\GetFromDocBlocks::class,
        ],
        'urlParameters' => [
            Strategies\UrlParameters\GetFromUrlParamTag::class,
        ],
        'queryParameters' => [
            Strategies\QueryParameters\GetFromQueryParamTag::class,
        ],
        'headers' => [
            Strategies\Headers\GetFromRouteRules::class => null,
        ],
        'bodyParameters' => [
            Strategies\BodyParameters\GetFromBodyParamTag::class,
        ],
        'responses' => [
            Strategies\Responses\UseResponseTag::class,
            Strategies\Responses\UseResponseFileTag::class,
            Strategies\Responses\UseApiResourceTags::class,
            Strategies\Responses\UseTransformerTags::class,
            // Supprimé ResponseCalls ici car nous n'en avons pas besoin
        ],
        'responseFields' => [
            Strategies\ResponseFields\GetFromResponseFieldTag::class,
        ],
    ],

    // Important : mettre à vide pour désactiver les transactions de base de données
    'database_connections_to_transact' => [],
]; 