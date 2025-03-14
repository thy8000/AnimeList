<?php

namespace AnimeList\Services\AniList;

if (!defined('ABSPATH')) {
   exit;
}

use AnimeList\Services\AniList\Factory;

class RestAPI
{
   private $api = null;

   public function __construct()
   {
      $Anilist_Factory = new Factory();
      $this->api = $Anilist_Factory->get_api();

      add_action('rest_api_init', [$this, 'custom_endpoints']);
   }

   public function custom_endpoints()
   {
      register_rest_route('anilist/api', '/search/', [
         'methods' => 'POST',
         'callback' => [$this, 'search_animes'],
         'args'    => [
            'filter' => [
               'required' => true,
               'validate_callback' => [$this, 'validate_search_animes_callback'],
            ],
         ],
      ]);
   }

   function validate_search_animes_callback($value, $request, $param)
   {
      if (empty($value)) {
         return new \WP_Error(
            'rest_invalid_param',
            esc_html__('O parâmetro query não pode estar vazio.', 'thunay'),
            ['status' => 400]
         );
      }

      return true;
   }

   function search_animes($request)
   {
      $filter = $request->get_param('filter');

      if (Utils::is_filter_empty($filter)) {
         return new \WP_Error('rest_invalid_param', esc_html__('Filtros inválidos.'), ['status' => 400]);
      }

      $response = $this->api->get_filter($filter);

      if (empty($response)) {
         return new \WP_Error('rest_invalid_param', esc_html__('Não foi encontrado nenhum resultado de acordo com o resultado da sua pesquisa.'), ['status' => 404]);
      }

      $html = '';

      ob_start();

      foreach ($response as $media) {
         echo '<li>';

         get_template_part('public/components/anime-card-vertical', null, [
            'data' => $media,
         ]);

         echo '</li>';
      }

      $html = ob_get_clean();

      return new \WP_REST_Response($html, 200);
   }
}
