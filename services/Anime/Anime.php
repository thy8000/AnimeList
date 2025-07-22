<?php

namespace AnimeList\Services\Anime;

use AnimeList\Services\AniList\Factory as Anilist_Factory;
use DateTime;

if (!defined('ABSPATH')) {
   exit;
}

class Anime
{
   private $data;
   private $relation_type = '';

   public function __construct($data = null, $relation_type = '')
   {
      if (is_int($data)) {
         $Anilist_Factory = new Anilist_Factory();
         $API = $Anilist_Factory->get_api();

         $this->data = $API->get_single_anime_info((int) $data);
      } else if (is_array($data) || is_object($data)) {
         $this->data = $data;
      } else {
         return;
      }

      if (!empty($relation_type)) {
         $this->relation_type = $relation_type;
      }
   }

   public function get_ID()
   {
      return $this->data['id'] ?? '';
   }

   public function get_title($language = 'romaji')
   {
      if (empty($this->data['title'])) {
         return;
      }

      if (empty($this->data['title'][$language])) {
         return reset($this->data['title']);
      }

      return $this->data['title'][$language];
   }

   public function get_image($size = 'medium')
   {
      if (empty($this->data['coverImage'])) {
         return;
      }

      if (empty($this->data['coverImage'][$size])) {
         return reset($this->data['coverImage']);
      }

      return $this->data['coverImage'][$size];
   }

   public function get_airing()
   {
      return $this->data['airing'] ?? null;
   }

   public function get_studio()
   {
      return $this->data['studio'] ?? null;
   }

   public function get_format()
   {
      return $this->data['format'] ?? null;
   }

   public function get_episodes_number()
   {
      return $this->data['episodes_number'] ?? null;
   }

   public function get_link()
   {
      if (empty($this->get_ID()) && empty($this->get_title())) {
         return;
      }

      return get_home_url() . '/anime/' . $this->get_ID() . '/' . strtolower(str_replace(' ', '-', $this->get_title()));
   }

   public function get_type()
   {
      if (empty($this->data['type'])) {
         return;
      }

      return ucfirst(strtolower($this->data['type']));
   }

   public function get_description()
   {
      return $this->data['description'] ?? null;
   }

   public function get_relation()
   {
      if (empty($this->data['relations']['edges'])) {
         return;
      }

      return (array) array_filter($this->data['relations']['edges'], function ($item) {
         if (empty($item['relationType'])) {
            return $item;
         }

         return $item['relationType'] !== 'CHARACTER';
      });
   }

   public function get_status()
   {
      if (empty($this->data['status'])) {
         return;
      }

      return str_replace("_", " ", ucfirst(strtolower($this->data['status'])));
   }

   public function get_recommended()
   {
      if (empty($this->data['recommendations']['nodes'])) {
         return;
      }

      return array_map(function ($item) {
         return $item['mediaRecommendation'];
      }, $this->data['recommendations']['nodes']);
   }

   public function get_relation_type()
   {
      if (empty($this->relation_type)) {
         return;
      }

      return ucfirst(strtolower(str_replace("_", " ", $this->relation_type)));
   }

   public function get_trailer()
   {
      if (empty($this->data['trailer'])) {
         return;
      }

      if ($this->data['trailer']['site'] === 'youtube') {
         return esc_url("https://www.youtube.com/embed/{$this->data['trailer']['id']}");
      }

      return esc_url("https://geo.dailymotion.com/player.html?video={$this->data['trailer']['id']}");
   }

   public function get_episodes()
   {
      return $this->data['episodes'] ?? null;
   }

   public function get_duration()
   {
      if (empty($this->data['duration'])) {
         return;
      }

      return sprintf(esc_html__('%s minutes', 'anime-list'), $this->data['duration']);
   }

   public function get_start_date()
   {
      $day = $this->data['startDate']['day'] ?? null;
      $month = $this->data['startDate']['month'] ?? null;
      $year = $this->data['startDate']['year'] ?? null;

      if (
         empty($day) ||
         empty($month) ||
         empty($year)
      ) {
         return;
      }

      $timestamp_date = mktime(0, 0, 0, $month, $day, $year);

      return date('M d, Y', $timestamp_date);
   }

   public function get_end_date()
   {
      $day = $this->data['endDate']['day'] ?? null;
      $month = $this->data['endDate']['month'] ?? null;
      $year = $this->data['endDate']['year'] ?? null;

      if (
         empty($day) ||
         empty($month) ||
         empty($year)
      ) {
         return;
      }

      $timestamp_date = mktime(0, 0, 0, $month, $day, $year);

      return date('M d, Y', $timestamp_date);
   }

   public function get_average_score()
   {
      if (empty($this->data['averageScore'])) {
         return;
      }

      return "{$this->data['averageScore']}/100";
   }

   public function get_popularity()
   {
      if (empty($this->data['popularity'])) {
         return;
      }

      return $this->data['popularity'];
   }

   public function get_favourites()
   {
      if (empty($this->data['favourites'])) {
         return;
      }

      return $this->data['favourites'];
   }

   public function get_studios(bool $is_main = true)
   {
      if (empty($this->data['studios']['nodes'])) {
         return;
      }

      $studios_data = array_map(function ($item) use ($is_main) {
         if (!empty($item['isAnimationStudio']) && !empty($is_main)) {
            return $item['name'];
         }

         if (empty($item['isAnimationStudio']) && empty($is_main)) {
            return $item['name'];
         }

         return [];
      }, $this->data['studios']['nodes']);

      $studios_data = array_filter($studios_data);

      return implode('<br>', array_unique($studios_data));
   }

   public function get_source()
   {
      if (empty($this->data['source'])) {
         return;
      }

      return ucfirst(strtolower(str_replace("_", " ", $this->data['source'])));
   }

   public function get_genres()
   {
      if (empty($this->data['genres'])) {
         return;
      }

      return implode('<br>', $this->data['genres']);
   }

   public function get_additional_info()
   {
      // TODO: Adittional info for manga.

      $additional_info = [
         'format' => [
            'title' => __('Format', 'anime-list'),
            'data'  => $this->get_format() ?? null
         ],
         'episodes' => [
            'title' => __('Episodes', 'anime-list'),
            'data'  => $this->get_episodes() ?? null
         ],
         'duration' => [
            'title' => __('Duration', 'anime-list'),
            'data' => $this->get_duration() ?? null,
         ],
         'status' => [
            'title' => __('Status', 'anime-list'),
            'data'  => $this->get_status() ?? null,
         ],
         'startDate' => [
            'title' => __('Start date', 'anime-list'),
            'data'  => $this->get_start_date(),
         ],
         'endDate' => [
            'title' => __('End date', 'anime-list'),
            'data'  => $this->get_end_date(),
         ],
         'averageScore' => [
            'title' => __('Average score', 'anime-list'),
            'data'  => $this->get_average_score(),
         ],
         'popularity' => [
            'title' => __('Popularity', 'anime-list'),
            'data'  => $this->get_popularity(),
         ],
         'favorites' => [
            'title' => __('Favorites', 'anime-list'),
            'data'  => $this->get_favourites(),
         ],
         'studios' => [
            'title' => __('Studios', 'anime-list'),
            'data'  => $this->get_studios(),
         ],
         'producers' => [
            'title' => __('Producers', 'anime-list'),
            'data'  => $this->get_studios(false),
         ],
         'source' => [
            'title' => __('Source', 'anime-list'),
            'data'  => $this->get_source(),
         ],
         'source' => [
            'title' => __('Genres', 'anime-list'),
            'data'  => $this->get_genres(),
         ],
      ];

      return array_filter($additional_info, function ($item) {
         return !empty($item['data']);
      });
   }

   public function get_tags()
   {
      if (empty($this->data['tags'])) {
         return;
      }

      return $this->data['tags'];
   }
}
