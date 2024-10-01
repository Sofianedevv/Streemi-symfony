<?php

namespace App\enum;

enum MediaType: string
{
    case Movie = 'movie';          // Pour les films
    case Series = 'series';        // Pour les séries
    case Documentary = 'documentary'; // Pour les documentaires
    case ShortFilm = 'short_film'; // Pour les courts métrages
    case Animation = 'animation';  // Pour les films d'animation
}
