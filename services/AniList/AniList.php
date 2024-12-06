<?php

namespace AnimeList\Services\AniList;

use AnimeList\Services\Graphql\GraphqlQueryBuilder;
use AnimeList\Services\Request;
use AnimeList\Services\Anilist\Utils as AniListUtils;

include get_template_directory() . '/vendor/autoload.php';

if (!defined('ABSPATH')) {
   exit;
}

class AniList
{
   private $api_url = "https://graphql.anilist.co";
   private $request;
   private $query;
   private $query_builder;

   public function __construct()
   {
      $this->request = new Request();

      $this->query_builder = new GraphqlQueryBuilder();
   }

   public function get_genres()
   {
      $this->query = $this->query_builder
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

   public function get_trending_now(int $per_page = 5)
   {
      $this->query = $this->query_builder
         ->set_query('getTrendingNow')
         ->set_object('Page', [
            'page' => [
               'value' => 1,
               'type'  => 'Int',
            ],
            'perPage' => [
               'value' => $per_page,
               'type'  => 'Int',
            ]
         ])
         ->set_field('media', [
            'sort' => [
               'value' => 'TRENDING_DESC',
               'type'  => 'MediaSort',
            ]
         ])
         ->set_sub_fields([
            'title' => [
               'romaji',
            ],
            'coverImage' => [
               'extraLarge',
               'large',
               'medium'
            ]
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

   public function get_season_popular(int $page = 1, int $per_page = 5)
   {
      $this->query = $this->query_builder
         ->set_query('getPopularThisSeason')
         ->set_object('Page', [
            'page' => [
               'value' => $page,
               'type'  => 'Int',
            ],
            'perPage' => [
               'value' => $per_page,
               'type'  => 'Int',
            ]
         ])
         ->set_field('media', [
            'season' => [
               'value' => AniListUtils::get_current_season(),
               'type'  => 'MediaSeason',
            ],
            'seasonYear' => [
               'value' => date('Y'),
               'type'  => 'Int'
            ],
            'sort' => [
               'value' => 'POPULARITY_DESC',
               'type'  => 'MediaSort',
            ]
         ])
         ->set_sub_fields([
            'id',
            'title' => [
               'romaji',
               'english',
               'native',
            ],
            'coverImage' => [
               'extraLarge',
               'large',
               'medium',
            ],
            'popularity',
            'format',
            'status',
            'season',
            'seasonYear'
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

   public function get_upcoming_next_season(int $page = 1, int $per_page = 5)
   {
      $season_and_year = AniListUtils::get_next_season_and_year();

      $this->query = $this->query_builder
         ->set_query('getUpcomingNextSeason')
         ->set_object('Page', [
            'page' => [
               'value' => $page,
               'type' => 'Int'
            ],
            'perPage' => [
               'value' => $per_page,
               'type' => 'Int'
            ]
         ])
         ->set_field('media', [
            'season' => [
               'value' => $season_and_year['season'],
               'type' => 'MediaSeason'
            ],
            'seasonYear' => [
               'value' => $season_and_year['year'],
               'type' => 'MediaSeason'
            ],
            'sort' => [
               'value' => 'POPULARITY_DESC',
               'type' => 'MediaSort'
            ]
         ])
         ->set_sub_fields([
            'id',
            'title' => [
               'romaji',
               'english',
               'native',
            ],
            'coverImage' => [
               'extraLarge',
               'large',
               'medium'
            ],
            'popularity',
            'format',
            'status',
            'season',
            'seasonYear'
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

   public function get_all_time_popular($page = 1, $per_page = 5)
   {
      $this->query = $this->query_builder
         ->set_query('getAllTimePopular')
         ->set_object('Page', [
            'page' => [
               'value' => $page,
               'type' => 'Int'
            ],
            'perPage' => [
               'value' => $per_page,
               'type' => 'Int'
            ]
         ])
         ->set_field('media', [
            'sort' => [
               'value' => 'POPULARITY_DESC',
               'type' => 'MediaSort'
            ]
         ])
         ->set_sub_fields([
            'id',
            'title' => [
               'romaji',
               'english',
               'native',
            ],
            'coverImage' => [
               'extraLarge',
               'large',
               'medium'
            ],
            'popularity',
            'format',
            'status',
            'season',
            'seasonYear'
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

   public function get_filter($args = [])
   {
      if (empty($args)) {
         return;
      }

      $object_args = array_filter($args);

      $this->query = $this->query_builder
         ->set_query('getFilter')
         ->set_object('Page', [
            'page' => [
               'value' => 1,
               'type'  => 'Int',
            ],
            'perPage' => [
               'value' => 50,
               'type'  => 'Int',
            ]
         ])
         ->set_field('media', $object_args)
         ->set_sub_fields([
            'id',
            'title' => [
               'romaji',
               'english',
               'native',
            ],
            'coverImage' => [
               'extraLarge',
               'large',
               'medium'
            ],
            'popularity',
            'format',
            'status',
            'season',
            'seasonYear'
         ])
         ->build();

      $this->request->post(
         $this->api_url,
         [
            'query' => $this->query,
         ]
      );

      if (empty($this->request->response['data']['Page']['media'])) {
         return [];
      }

      return $this->request->response['data']['Page']['media'];
   }
}
