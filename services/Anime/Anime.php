<?php

namespace AnimeList\Services\Anime;

use AnimeList\Services\AniList\Factory as Anilist_Factory;

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

   public function get_tags()
   {
      return $this->data['tags'] ?? null;
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
}
