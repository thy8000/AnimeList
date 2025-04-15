<?php

namespace AnimeList\Services\Page;

if (!defined('ABSPATH')) {
   exit;
}

class Register
{
   public function __construct()
   {
      add_action('init', [$this, 'register_virtual_pages']);

      add_filter('query_vars', [$this, 'register_query_vars']);
      add_filter('template_include', [$this, 'register_custom_templates']);
   }

   public function register_virtual_pages()
   {
      add_rewrite_rule('^anime/([0-9]+)/([^/]+)/?$', 'index.php?anime_ID=$matches[1]&anime_title=$matches[2]', 'top');
   }

   public function register_query_vars($vars)
   {
      $vars[] = 'anime_ID';
      $vars[] = 'anime_title';

      return $vars;
   }

   public function register_custom_templates($template)
   {
      if (get_query_var('anime_ID') && get_query_var('anime_title')) {
         return get_template_directory() . '/public/pages/virtual-page-anime/_index.php';
      }

      return $template;
   }
}
