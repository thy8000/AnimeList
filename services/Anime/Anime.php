<?php

namespace AnimeList\Services\Anime;

if (!defined('ABSPATH')) {
   exit;
}

class Anime
{
   private $data;

   public function __construct($data)
   {
      if (empty($data)) {
         return;
      }

      $this->data = $data;
   }

   public function get_title($language = 'romaji')
   {
      return $this->data['title'][$language];
   }

   public function get_image($size = 'medium')
   {
      return $this->data['coverImage'][$size];
   }

   public function get_airing()
   {
      return $this->data['airing'];
   }

   public function get_studio()
   {
      return $this->data['studio'];
   }

   public function get_format()
   {
      return $this->data['format'];
   }

   public function get_episodes_number()
   {
      return $this->data['episodes_number'];
   }

   public function get_tags()
   {
      return $this->data['tags'];
   }
}
