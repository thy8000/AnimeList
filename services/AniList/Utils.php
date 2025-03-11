<?php

namespace AnimeList\Services\AniList;

if (!defined('ABSPATH')) {
   exit;
}

class Utils
{
   public static function get_genres(array $genres)
   {
      $_genres = [];

      foreach ($genres as $genre) {
         $lowerstring_genre = strtolower($genre);

         $_genres[$lowerstring_genre] = $genre;
      }

      $_genres = array_merge(['any' => 'Any'], $_genres);

      return $_genres;
   }
}
