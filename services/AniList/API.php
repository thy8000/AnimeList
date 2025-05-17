<?php

namespace AnimeList\Services\AniList;

use AnimeList\Services\Anime\APIInterface;
use AnimeList\Services\Request\Curl;
use AnimeList\Services\GraphQL\QueryBuilder;
use AnimeList\Services\AniList\Utils;

if (!defined('ABSPATH')) {
   exit;
}

class API implements APIInterface
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

   public function get_trending_now()
   {
      $this->query = $this->Query_Builder
         ->set_query('getTrendingNow')
         ->set_object('Page', [
            'page' => [
               'value' => 1,
               'type'  => 'Int',
            ],
            'perPage' => [
               'value' => 5,
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
            'id',
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

   public function get_season_popular()
   {
      $this->query = $this->Query_Builder
         ->set_query('getPopularThisSeason')
         ->set_object('Page', [
            'page' => [
               'value' => 1,
               'type'  => 'Int',
            ],
            'perPage' => [
               'value' => 5,
               'type'  => 'Int',
            ]
         ])
         ->set_field('media', [
            'season' => [
               'value' => Utils::get_current_season(),
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

   public function get_upcoming_next_season()
   {
      $season_and_year = Utils::get_next_season_and_year();

      $this->query = $this->Query_Builder
         ->set_query('getUpcomingNextSeason')
         ->set_object('Page', [
            'page' => [
               'value' => 1,
               'type' => 'Int'
            ],
            'perPage' => [
               'value' => 5,
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

   public function get_all_time_popular()
   {
      $this->query = $this->Query_Builder
         ->set_query('getAllTimePopular')
         ->set_object('Page', [
            'page' => [
               'value' => 1,
               'type' => 'Int'
            ],
            'perPage' => [
               'value' => 5,
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

      $args = array_filter($args, function ($value) {
         return $value !== 'Any' && trim($value) !== '';
      });

      $object_args['type'] = [
         'value' => 'ANIME',
         'type'  => 'MediaType'
      ];

      if (isset($args['search']) && !empty($args['search'])) {
         $object_args['search'] = [
            'value' => $args['search'],
            'type'  => 'String',
         ];
      }

      if (isset($args['genre']) && !empty($args['genre'])) {
         $object_args['genre_in'] = [
            'value' => is_array($args['genre']) ? $args['genre'] : [$args['genre']],
            'type'  => '[String]'
         ];

         $object_args['sort'] = [
            'value' => 'POPULARITY_DESC',
            'type'  => 'MediaSort'
         ];
      }

      if (isset($args['seasonYear']) && !empty($args['seasonYear'])) {
         $object_args['seasonYear'] = [
            'value' => $args['seasonYear'],
            'type'  => 'Int'
         ];

         $object_args['sort'] = [
            'value' => 'POPULARITY_DESC',
            'type'  => 'MediaSort'
         ];
      }

      if (isset($args['season']) && !empty($args['season'])) {
         $object_args['season'] = [
            'value' => $args['season'],
            'type'  => 'MediaSeason'
         ];

         $object_args['sort'] = [
            'value' => 'START_DATE_DESC',
            'type'  => 'MediaSort'
         ];
      }

      if (isset($args['format']) && !empty($args['format'])) {
         $object_args['format'] = [
            'value' => $args['format'],
            'type'  => 'MediaFormat',
         ];

         $object_args['sort'] = [
            'value' => 'START_DATE_DESC',
            'type'  => 'MediaSort',
         ];
      }

      $this->query = $this->Query_Builder
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

   public function get_single_anime_info(int $anime_ID = 0)
   {
      $this->query = $this->Query_Builder
         ->set_query('getSingleAnimeInfo')
         ->set_object('Media', [
            'id' => [
               'value' => $anime_ID,
               'type' => 'Int',
            ]
         ])
         ->set_sub_fields([
            'title' => [
               'romaji',
               'english',
               'native',
            ],
            'type',
            'coverImage' => [
               'extraLarge',
            ],
            'description',
            'relations' => [
               'edges' => [
                  'relationType',
                  'node' => [
                     'id',
                     'title' => [
                        'romaji',
                        'english',
                     ],
                     'status',
                     'coverImage' => [
                        'extraLarge',
                     ],
                  ]
               ]
            ],
            'recommendations' => [
               'nodes' => [
                  'mediaRecommendation' => [
                     'id',
                     'coverImage' => [
                        'extraLarge'
                     ],
                     'title' => [
                        'romaji',
                        'english',
                        'native',
                     ],
                     'status'
                  ]
               ]
            ],
            'trailer' => [
               'id',
               'site',
            ],
         ])
         ->build();

      $this->request->post(
         $this->api_url,
         [
            'query' => $this->query,
         ]
      );

      return $this->request->response['data']['Media'];
   }
}
