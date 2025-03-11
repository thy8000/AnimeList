<?php

namespace AnimeList\Services\Anime;

if (!defined('ABSPATH')) {
   exit;
}

abstract class Factory
{
   protected string $api_url;

   abstract public function get_api();
}
