<?php

namespace AnimeList\Services\AniList;

use AnimeList\Services\AniList\API;
use AnimeList\Services\Anime\APIFactory as AnimeAPIFactory;

if (!defined('ABSPATH')) {
   exit;
}

class Factory extends AnimeAPIFactory
{
   public function get_api()
   {
      return new API();
   }
}
