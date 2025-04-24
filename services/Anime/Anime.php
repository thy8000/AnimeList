<?php

namespace AnimeList\Services\Anime;

use AnimeList\Services\AniList\Factory as Anilist_Factory;

if (!defined('ABSPATH')) {
   exit;
}

class Anime
{
   private $data;

   public function __construct($data = null)
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
   }

   public function get_ID()
   {
      return $this->data['id'];
   }

   public function get_title($language = 'romaji')
   {
      if (empty($this->data['title'][$language])) {
         return reset($this->data['title']);
      }

      return $this->data['title'][$language];
   }

   public function get_image($size = 'medium')
   {
      if (empty($this->data['coverImage'][$size])) {
         return reset($this->data['coverImage']);
      }

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

   public function get_link()
   {
      return get_home_url() . '/anime/' . $this->get_ID() . '/' . strtolower(str_replace(' ', '-', $this->get_title()));
   }

   public function get_type()
   {
      return ucfirst(strtolower($this->data['type']));
   }

   public function get_description()
   {
      return $this->data['description'];
   }

   public function get_relation()
   {
      return $this->data['relations']['edges'];
   }
}
