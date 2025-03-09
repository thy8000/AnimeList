<?php

namespace AnimeList\Services\Anime;

if (!defined('ABSPATH')) {
   exit;
}

interface AnimeInterface
{
   public function get_genres();
}
