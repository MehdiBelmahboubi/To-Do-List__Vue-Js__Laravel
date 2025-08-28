# 📝 To-Do List Application - Full Stack

Une application complète de gestion de tâches développée avec **Laravel** (backend) et **Vue.js** (frontend), incluant l'authentification JWT et les notifications en temps réel.

![To-Do List App](https://img.shields.io/badge/Status-En%20développement-brightgreen)
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
