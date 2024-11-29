<?php

namespace AnimeList\Core;

if (!defined('ABSPATH')) {
   exit;
}

class TemplateHierarchy
{
   public $templates = [
      '404',
      'archive',
      'attachment',
      'author',
      'category',
      'date',
      'embed',
      'frontpage',
      'home',
      'index',
      'page',
      'paged',
      'privacypolicy',
      'search',
      'single',
      'singular',
      'tag',
      'taxonomy',
   ];

   public function __construct()
   {
      foreach ($this->templates as $template) {
         add_filter("{$template}_template_hierarchy", [$this, 'template_hierarchy']);
      }
   }

   public function template_hierarchy($templates)
   {
      if (false !== strpos($templates[0], 'public/pages/')) {
         return $templates;
      }

      foreach ($templates as $template) {
         $index           = str_replace('.php', '/_index.php', $template);
         $new_templates[] = "public/pages/{$index}";
         $new_templates[] = "public/pages/{$template}";
      }

      return array_merge($new_templates, $templates);
   }
}
