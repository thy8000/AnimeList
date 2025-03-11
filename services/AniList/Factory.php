<?php

namespace AnimeList\Services\AniList;

use AnimeList\Services\AniList\API;
use AnimeList\Services\Anime\Factory as AnimeFactory;

if (!defined('ABSPATH')) {
   exit;
}

class Factory extends AnimeFactory
{
   public function get_api()
   {
      return new API();
   }
}
