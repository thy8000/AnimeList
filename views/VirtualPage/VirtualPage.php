<?php

namespace AnimeList\Views\VirtualPage;

if (!defined('ABSPATH')) {
   exit;
}

class VirtualPage
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
      add_rewrite_rule('^trending-now/?$', 'index.php?trending_now=true', 'top');
   }

   public function register_query_vars($vars)
   {
      $vars[] = 'anime_ID';
      $vars[] = 'anime_title';
      $vars[] = 'trending_now';

      return $vars;
   }

   public function register_custom_templates($template)
   {
      if (get_query_var('anime_ID') && get_query_var('anime_title')) {
         return get_template_directory() . '/public/pages/virtual-page-anime/_index.php';
      }

      if (get_query_var('trending_now')) {
         return get_template_directory() . '/public/pages/virtual-page-trending-now/_index.php';
      }

      return $template;
   }
}
