<?php

namespace AnimeList\Services\AniList;

use AnimeList\Services\Anime\AnimeInterface;
use AnimeList\Services\Request\Curl;
use AnimeList\Services\GraphQL\QueryBuilder;

if (!defined('ABSPATH')) {
   exit;
}

class API implements AnimeInterface
{
   private $api_url = "https://graphql.anilist.co";
   private $request;
   private $query;
   private $Query_Builder;

   public function __construct()
   {
      $this->request = new Curl();
      $this->Query_Builder = new QueryBuilder();
   }

   public function get_genres()
   {
      $this->query = $this->Query_Builder
         ->set_query('getGenres')
         ->set_sub_fields(['GenreCollection'])
         ->build();

      $this->request->post(
         $this->api_url,
         [
            'query' => $this->query,
         ]
      );

      return $this->request->response['data']['GenreCollection'];
   }
}
