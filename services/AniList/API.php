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

   public function get_oldest_anime()
   {
      $this->query = $this->Query_Builder
         ->set_query('getOldestAnime')
         ->set_object('Page', [
            'perPage' => [
               'value' => 1,
               'type'  => 'Int'
            ]
         ])
         ->set_field('media', [
            'type' => [
               'value' => 'ANIME',
               'type'  => 'MediaType'
            ],
            'sort' => [
               'value' => 'START_DATE',
               'type'  => 'MediaSort',
            ],
            'startDate_greater' => [
               'value' => '19000000',
               'type'  => 'FuzzyDateInt',
            ]
         ])
         ->set_sub_fields([
            'startDate' => [
               'year'
            ],
         ])
         ->build();

      $this->request->post(
         $this->api_url,
         [
            'query' => $this->query,
         ]
      );

      return $this->request->response['data']['Page']['media'];
   }

   public function get_seasons()
   {
      $this->query = $this->Query_Builder
         ->set_query('getSeasons')
         ->set_field('__type', [
            'name' => [
               'value' => 'MediaSeason',
               'type'  => 'String'
            ]
         ])
         ->set_sub_fields([
            'enumValues' => [
               'name',
            ]
         ])
         ->build();


      $this->request->post(
         $this->api_url,
         [
            'query' => $this->query,
         ]
      );

      return $this->request->response['data']['__type']['enumValues'];
   }

   public function get_formats()
   {
      $this->query = $this->Query_Builder
         ->set_query('getFormats')
         ->set_field('__type', [
            'name' => [
               'value' => 'MediaFormat',
               'type'  => 'String'
            ]
         ])
         ->set_sub_fields([
            'enumValues' => [
               'name',
            ]
         ])
         ->build();


      $this->request->post(
         $this->api_url,
         [
            'query' => $this->query,
         ]
      );

      return $this->request->response['data']['__type']['enumValues'];
   }
}
