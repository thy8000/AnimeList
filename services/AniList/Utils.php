<?php

namespace AnimeList\Services\AniList;

if (!defined('ABSPATH')) {
   exit;
}

class Utils
{
   private static $seasons = ['WINTER', 'SPRING', 'SUMMER', 'FALL'];

   public static function get_current_season()
   {
      $current_month = date('n');

      if ($current_month >= 1 && $current_month <= 3) {
         return self::$seasons[0];
      } elseif ($current_month >= 4 && $current_month <= 6) {
         return self::$seasons[1];
      } elseif ($current_month >= 7 && $current_month <= 9) {
         return self::$seasons[2];
      } else {
         return self::$seasons[3];
      }
   }

   public static function get_next_season_and_year()
   {
      $currentMonth = date('n');
      $currentYear = date('Y');

      if ($currentMonth >= 1 && $currentMonth <= 3) {
         $season = 'SPRING';
         $year = $currentYear;
      } elseif ($currentMonth >= 4 && $currentMonth <= 6) {
         $season = 'SUMMER';
         $year = $currentYear;
      } elseif ($currentMonth >= 7 && $currentMonth <= 9) {
         $season = 'FALL';
         $year = $currentYear;
      } else {
         $season = 'WINTER';
         $year = $currentYear + 1;
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
