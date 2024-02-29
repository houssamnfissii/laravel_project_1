# Application de Réservation de Voyages

## Introduction
Ce projet est une application de réservation de voyages qui permet aux utilisateurs de découvrir et de réserver des voyages passionnants. Il comprend cinq tables principales : `trip`, `activite`, `users`, `review`, et `usertrip`, avec des relations spécifiques entre elles.

## Modèles de Données
- `trip` et `activite` ont une relation many-to-many (n-n).
- `trip` et `users` ont une relation one-to-many (1-n).
- `review` et `trip` ont une relation one-to-many (1-n).
- `usertrip` et `trip` ont une relation one-to-many (1-n).

## Fonctionnalités Administrateur
L'administrateur dispose d'un tableau de bord avec les fonctionnalités suivantes :
- Ajouter, modifier et supprimer des voyages (`trips`).
- Créer des activités pour les voyages.
- Filtrer les voyages.
- Importer et exporter des voyages au format Excel.
- Supprimer des utilisateurs.
- Supprimer des avis (`reviews`).
- Consulter la liste des avis.

## Fonctionnalités Utilisateurs
Les utilisateurs peuvent :
- Réserver des voyages.
- Télécharger un PDF contenant les détails du voyage et leurs propres informations.
- Supprimer des voyages de leur liste de voyages réservés.

## Tests Unitaires
Des tests unitaires sont mis en place pour les contrôleurs de voyages (`trip`) afin de tester la création et la mise à jour de voyages.


