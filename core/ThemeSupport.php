<?php

namespace AnimeList\Core;

if (!defined('ABSPATH')) {
   exit;
}

class ThemeSupport
{
   public $mimes = [
      'svg' => 'image/svg+xml',
      'png' => 'image/png',
   ];

   public function __construct()
   {
      add_filter('upload_mimes', [$this, 'register_svg_support']);
      add_action('init', [$this, 'register_theme_support']);
   }

   public function register_svg_support()
   {
      foreach ($this->mimes as $key => $mime) {
         $mimes[$key] = $mime;
      }

      return $mimes;
   }

   public function register_theme_support()
   {
      add_theme_support('post-thumbnails');
   }
}
