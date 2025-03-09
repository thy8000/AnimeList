<?php

namespace AnimeList\Services\Anime;

use AnimeList\Services\Anime\Anilist;
use AnimeList\Services\Anime\AnimeFactory;

if (!defined('ABSPATH')) {
   exit;
}

class AnilistFactory extends AnimeFactory
{
   public function get_api()
   {
      return new Anilist();
   }
}
