<?php

namespace AnimeList\Services\Anime;

if (!defined('ABSPATH')) {
   exit;
}

abstract class AnimeFactory
{
   abstract public function get_api();
}
