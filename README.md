# Space Tourism

## À propos du projet

Space Tourism est une application web permettant d'explorer les destinations spatiales, les technologies de voyage spatial et les membres d'équipage. Ce projet combine un backend Laravel avec une interface utilisateur moderne.

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- MySQL 8.0 ou supérieur
- Node.js et NPM (pour les assets frontend)
- Git

## Installation

Suivez ces étapes pour installer le projet sur votre machine locale :

### 1. Cloner le dépôt

```bash
git clone https://github.com/ADJADI/space.git
cd space
```

### 2. Installer les dépendances PHP

```bash
cd space-backend
composer install
```

### 3. Configurer l'environnement

Copiez le fichier d'environnement et générez une clé d'application :

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurez votre base de données

Modifiez le fichier `.env` pour configurer votre connexion à la base de données :

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=space
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Exécuter les migrations et les seeders

```bash
php artisan migrate --seed
```

### 6. Lancer le serveur

```bash
php artisan serve
```

Le site sera accessible à l'adresse `http://localhost:8000`

## Structure du projet

- `app/` - Contient le code de l'application backend
- `resources/` - Contient les vues, assets et fichiers frontend
- `public/images/` - Stockage des images utilisées dans l'application
- `routes/` - Définition des routes de l'application
- `database/` - Migrations et seeders de la base de données

## Structure du code

### Modèles

Les modèles se trouvent dans le dossier `app/Models`. Les principaux modèles sont :

- `Destination` - Représente une destination spatiale
- `CrewMember` - Représente un membre d'équipage
- `Technology` - Représente une technologie de voyage spatial

Exemple de modèle :

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'travel_time',
        'distance',
    ];
}
```

### Contrôleurs API

Les contrôleurs API se trouvent dans `app/Http/Controllers/Api`. Chaque contrôleur gère les endpoints relatifs à une ressource :

- `DestinationController` - Endpoints pour les destinations
- `CrewMemberController` - Endpoints pour les membres d'équipage
- `TechnologyController` - Endpoints pour les technologies

Structure typique d'un contrôleur API :

```php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Liste toutes les destinations
     */
    public function index()
    {
        $destinations = Destination::all();
        return response()->json(['data' => $destinations]);
    }

    /**
     * Affiche une destination spécifique
     */
    public function show($id)
    {
        $destination = Destination::findOrFail($id);
        return response()->json(['data' => $destination]);
    }
}
```

### Ajout de nouvelles fonctionnalités

Pour ajouter une nouvelle fonctionnalité :

1. Créez ou modifiez le modèle dans `app/Models`
2. Ajoutez les migrations correspondantes dans `database/migrations`
3. Créez un contrôleur dans `app/Http/Controllers`
4. Définissez les routes dans `routes/web.php` ou `routes/api.php`
5. Ajoutez les seeders dans `database/seeders` si nécessaire

## API Endpoints

### Destinations

- `GET /api/destinations` - Liste toutes les destinations
- `GET /api/destinations/{id}` - Affiche une destination spécifique

### Membres d'équipage

- `GET /api/crew` - Liste tous les membres d'équipage
- `GET /api/crew/{id}` - Affiche un membre d'équipage spécifique

### Technologies

- `GET /api/technologies` - Liste toutes les technologies
- `GET /api/technologies/{id}` - Affiche une technologie spécifique

## Administration

Un tableau de bord d'administration est disponible à l'adresse `/admin`. Vous devez être connecté avec des privilèges d'administrateur pour y accéder.

### Routes d'authentification

- `GET /login` - Page de connexion
- `GET /register` - Page d'inscription

## Déploiement

### Déploiement sur Railway

L'application est configurée pour un déploiement sur Railway. Suivez ces étapes pour déployer :

1. Créez un compte sur [Railway](https://railway.app/)

2. Installez l'outil CLI Railway :

```bash
npm i -g @railway/cli
```

3. Connectez-vous à Railway :

```bash
railway login
```

4. Initialisez votre projet :

```bash
railway init
```

5. Liez votre dépôt :

```bash
railway link
```

6. Configurez les variables d'environnement sur Railway :

```bash
railway variables set APP_NAME=Space
railway variables set APP_ENV=production
railway variables set APP_KEY=base64:votre_cle_ici
railway variables set APP_DEBUG=false
railway variables set APP_URL=https://votre-domaine.up.railway.app
railway variables set DATABASE_URL=mysql://utilisateur:mot_de_passe@hote:port/base_de_donnees
railway variables set SESSION_DRIVER=file
railway variables set SESSION_LIFETIME=120
railway variables set SESSION_DOMAIN=.up.railway.app
railway variables set SESSION_SECURE_COOKIE=true
```

7. Déployez l'application :

```bash
railway up
```

8. Exécutez les migrations et seeders sur Railway :

```bash
railway run "php artisan migrate --seed --force"
```

## Documentation

### Installation de Scribe pour la documentation de l'API

Scribe est un générateur de documentation API pour Laravel qui crée une documentation interactive à partir de votre code.

1. Installer Scribe :

```bash
composer require --dev knuckleswtf/scribe
```

2. Publier les fichiers de configuration :

```bash
php artisan vendor:publish --provider="Knuckles\Scribe\ScribeServiceProvider" --tag=scribe-config
```

3. Configurer Scribe dans `config/scribe.php` :

```php
// Définir les routes à documenter
'routes' => [
    [
        'match' => [
            'prefixes' => ['api/*'],
            'domains' => ['*'],
        ],
        'include' => ['api/destinations*', 'api/crew*', 'api/technologies*'],
        'exclude' => ['api/login', 'api/logout'],
    ],
],

// Définir le titre de la documentation
'title' => 'API Space Tourism',
```

4. Générer la documentation :

```bash
php artisan scribe:generate
```

5. Accéder à la documentation à l'adresse `/docs`.

### Annotations pour améliorer la documentation

Pour de meilleurs résultats, utilisez des annotations PHPDoc dans vos contrôleurs API. Exemple :

```php
/**
 * @group Destinations
 *
 * Liste toutes les destinations spatiales
 *
 * @response 200 {
 *     "data": [
 *         {
 *             "id": 1,
 *             "name": "Lune",
 *             "description": "Description de la Lune...",
 *             "image": "/images/destination/moon.png",
 *             "travel_time": "3 jours",
 *             "distance": "384 400 km"
 *         }
 *     ]
 * }
 */
public function index()
{
    // Code du contrôleur
}
```

## Licence

Ce projet est sous licence MIT.
