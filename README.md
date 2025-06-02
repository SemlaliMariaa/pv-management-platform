Plateforme de Gestion des Procès-Verbaux (PV Management Platform)

Description:

La Plateforme de Gestion des Procès-Verbaux est une application web développée en Laravel, conçue pour simplifier la création, la gestion et l’impression des procès-verbaux officiels des associations. Elle permet une gestion centralisée des données avec une interface intuitive adaptée aux utilisateurs non techniques.

Objectifs:

Faciliter la rédaction des procès-verbaux.
Offrir un outil numérique sécurisé et fiable.
Permettre l’export des documents en PDF.
Assurer une gestion simple des utilisateurs et des droits d’accès.

Fonctionnalités clés:

Authentification sécurisée des utilisateurs.
Gestion multi-type de procès-verbaux.
Interface responsive et ergonomique.
Impression des PV au format PDF.
Base de données structurée avec Laravel Eloquent.

Technologies utilisées:

Backend: Laravel 10 (PHP)
Base de données: MySQL 
Frontend: Blade Templates, Tailwind CSS
Gestionnaire de dépendances: Composer

Contrôle de version: Git

Installation
Cloner le dépôt :
git clone https://github.com/MariaSemlali1/pv-management-platform.git

Installer les dépendances :
composer install


Copier le fichier de configuration et le configurer :
cp .env.example .env


Modifier .env avec les paramètres de votre base de données.

Générer la clé de l’application :
php artisan key:generate


Lancer les migrations :
php artisan migrate


Démarrer le serveur local :
php artisan serve

Utilisation
Accéder à l’application via l’adresse indiquée (par défaut http://localhost:8000).
S’inscrire ou se connecter.
Créer, modifier et imprimer des procès-verbaux facilement.

Auteurs
Yousef laraaje
Zakaria Genaoui
Maria Semlali

Licence
Ce projet est sous licence MIT.


