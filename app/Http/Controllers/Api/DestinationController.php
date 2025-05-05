<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;

/**
 * @group Destinations
 *
 * Endpoints pour gérer les destinations spatiales
 */
class DestinationController extends Controller
{
    /**
     * Liste toutes les destinations
     * 
     * Cette endpoint renvoie toutes les destinations spatiales disponibles.
     *
     * @response 200 {
     *     "data": [
     *         {
     *             "id": 1,
     *             "name": "Lune",
     *             "description": "Voir notre planète bleue depuis l'espace est une expérience unique...",
     *             "image": "/images/destination/moon.png",
     *             "travel_time": "3 jours",
     *             "distance": "384 400 km"
     *         },
     *         {
     *             "id": 2,
     *             "name": "Mars",
     *             "description": "La planète rouge vous attend...",
     *             "image": "/images/destination/mars.png",
     *             "travel_time": "9 mois",
     *             "distance": "225 millions km"
     *         }
     *     ]
     * }
     */
    public function index()
    {
        $destinations = Destination::all();
        return response()->json(['data' => $destinations]);
    }

    /**
     * Affiche une destination spécifique
     * 
     * Cette endpoint renvoie les détails d'une destination spatiale spécifique.
     *
     * @urlParam id required L'ID de la destination. Example: 1
     * 
     * @response 200 {
     *     "data": {
     *         "id": 1,
     *         "name": "Lune",
     *         "description": "Voir notre planète bleue depuis l'espace est une expérience unique...",
     *         "image": "/images/destination/moon.png",
     *         "travel_time": "3 jours",
     *         "distance": "384 400 km"
     *     }
     * }
     * 
     * @response 404 {
     *     "message": "Destination not found"
     * }
     */
    public function show($id)
    {
        $destination = Destination::findOrFail($id);
        return response()->json(['data' => $destination]);
    }

    // ... existing code ...
} 