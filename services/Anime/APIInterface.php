<?php

namespace AnimeList\Services\Anime;

if (!defined('ABSPATH')) {
   exit;
}

interface APIInterface
{
   public function get_genres();
}
