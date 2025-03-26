<?php

namespace AnimeList\Services\AniList;

if (!defined('ABSPATH')) {
   exit;
}

class Utils
{
   private static $seasons = ['WINTER', 'SPRING', 'SUMMER', 'FALL'];

   public static function get_genres(array $genres)
   {
      $_genres = array_combine($genres, $genres);
      return array_merge(['Any' => 'Any'], $_genres);
   }

   public static function get_years($start_year, $end_year)
   {
      $years = [
         0 => 'Any',
      ];

      for ($year = $end_year; $year >= $start_year; $year--) {
         $years[$year] = $year;
      }

      return $years;
   }

   public static function get_current_season()
   {
      $current_month = date('n');

      switch (true) {
         case ($current_month >= 1 && $current_month <= 3):
            return self::$seasons[0];
         case ($current_month >= 4 && $current_month <= 6):
            return self::$seasons[1];
         case ($current_month >= 7 && $current_month <= 9):
            return self::$seasons[2];
         default:
            return self::$seasons[3];
      }
   }

   public static function get_next_season_and_year()
   {
      $current_month = date('n');
      $current_year = date('Y');

      $season = self::$seasons[0];
      $year = $current_year;

      if ($current_month >= 1 && $current_month <= 3) {
         $season = self::$seasons[1];
      } elseif ($current_month >= 4 && $current_month <= 6) {
         $season = self::$seasons[2];
      } elseif ($current_month >= 7 && $current_month <= 9) {
         $season = self::$seasons[3];
      } else {
         $season = self::$seasons[0];
         $year = $current_year + 1;
      }

      return ['season' => $season, 'year' => $year];
   }

   public static function is_filter_empty($filter)
   {
      $filtered_values = array_filter($filter, function ($value) {
         return !empty($value);
      });

      return empty($filtered_values);
   }
}
