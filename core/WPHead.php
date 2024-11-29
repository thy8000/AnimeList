<?php

namespace AnimeList\Core;

if (!defined('ABSPATH')) {
   exit;
}

class WPHead
{
   public function __construct()
   {
      add_action('wp_head', [$this, 'register_head_content'], 1);
   }

   public function register_head_content()
   {
      echo <<<OUTPUT
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       OUTPUT;
   }
}
