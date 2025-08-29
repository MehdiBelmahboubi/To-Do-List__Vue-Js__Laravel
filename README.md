# 📝 To-Do List Application - Full Stack

Une application complète de gestion de tâches développée avec **Laravel** (backend) et **Vue.js** (frontend), incluant l'authentification JWT et les notifications en temps réel.

![Laravel](https://img.shields.io/badge/Laravel-10.x-red)
![Vue.js](https://img.shields.io/badge/Vue.js-3.x-green)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange)

## 🚀 Fonctionnalités

### 🔐 Authentification
- **Inscription utilisateur** avec email, mot de passe, nom complet, téléphone, adresse et photo
- **Connexion sécurisée** avec JWT (JSON Web Tokens)
- **Middleware de protection** pour les routes API
- **Déconnexion** avec invalidation du token

### 📋 Gestion des tâches (CRUD Complet)
- ✅ **Créer** de nouvelles tâches
- 📖 **Lire** la liste des tâches
- ✏️ **Modifier** les tâches existantes
- 🗑️ **Supprimer** les tâches
- ✔️ **Marquer** les tâches comme complétées

### 🔔 Notifications en temps réel
- **Notifications instantanées** lors de la création de tâches
- **Interface dédiée** pour visualiser les notifications
- **Technologie WebSocket** avec Pusher et Laravel Echo

### 🏗️ Architecture Professionnelle
- **Repository Pattern** pour l'abstraction des données
- **Service Pattern** pour la logique métier
- **SOLID Principles** appliqués
- **Validation des données** avec Form Requests

## 🛠️ Stack Technologique

### Backend
- **Laravel 10** - Framework PHP
- **JWT Auth** - Authentification JSON Web Token
- **MySQL/PostgreSQL** - Base de données
- **Pusher** - Service WebSocket pour les notifications temps réel
- **Docker** - Containerisation (optionnel)

### Frontend
- **Vue.js 3** - Framework JavaScript
- **Pinia** - State Management
- **Axios** - Client HTTP pour les appels API
- **Laravel Echo** + **PusherJS** - Notifications temps réel
- **Vue Router** - Navigation SPA

## 📦 Installation et Démarrage

### Prérequis
- PHP 8.2+
- Composer
- Node.js 16+
- MySQL/PostgreSQL
- Compte Pusher (pour les notifications)

### 1. Clonez le dépôt

```bash
git clone https://github.com/MehdiBelmahboubi/To-Do-List__Vue-Js__Laravel.git
cd To-Do List

### 2. Configuration du Backend
# Aller dans le dossier backend
cd backend

# Installer les dépendances PHP
composer install

# Copier le fichier d'environnement
cp .env.example .env

# Générer la clé d'application Laravel
php artisan key:generate

# Générer la clé JWT
php artisan jwt:secret

# Configurer la base de données dans le fichier .env
# Editez le fichier .env avec vos paramètres de base de données :
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=todo_app
# DB_USERNAME=votre_utilisateur
# DB_PASSWORD=votre_mot_de_passe

# Créer la base de données (si elle n'existe pas déjà)
mysql -u root -p -e "CREATE DATABASE todo_app;"

# Exécuter les migrations
php artisan migrate

# (Optionnel) Charger des données de test
php artisan db:seed

# Démarrer le serveur backend
php artisan serve

### 3. Configuration du Frontend
# Ouvrir un nouveau terminal et aller dans le dossier frontend
cd frontend

# Installer les dépendances JavaScript
npm install

# Copier le fichier d'environnement
cp .env.example .env.local

# Configurer les variables d'environnement frontend
# Editez le fichier .env.local

# Démarrer le serveur de développement
npm run dev
