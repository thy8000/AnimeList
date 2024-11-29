<?php

namespace AnimeList\Core;

if (!defined('ABSPATH')) {
   exit;
}

class EnqueueScripts
{
   public function __construct()
   {
      add_action('wp_enqueue_scripts', [$this, 'register_global_scripts']);
      add_action('wp_enqueue_scripts', [$this, 'localize_scripts']);
   }

   public function register_global_scripts()
   {
      wp_enqueue_style('all', get_theme_file_uri('public/assets/output/all.min.css'));

      wp_enqueue_script('all', get_theme_file_uri('public/assets/output/all.min.js'), false, null, [
         'strategy' => 'defer',
         'in_footer' => false,
      ]);
   }

   public function localize_scripts()
   {
      wp_localize_script(
         'all',
         'globals',
         [
            'siteURL' => get_theme_file_uri(),
            'restAPI' => get_rest_url(),
         ]
      );
   }
}
