<?php

namespace AnimeList\Services\AniList;

// TODO: ADD NAMESPACES AND RENAME CLASSES

if (!defined('ABSPATH')) {
   exit;
}

class AniListRestAPI
{
   private $query_builder;
   private $request;
   private $api_url = 'https://graphql.anilist.co';
   private $media_api = null;

   function __construct()
   {
      $this->query_builder = new GraphQL_Query_Builder();
      $this->request = new Request();

      $this->media_api = new AniListCreator();
      $this->media_api = $this->media_api->get();

      add_action('rest_api_init', [$this, 'custom_endpoints']);
   }

   function custom_endpoints()
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
         return new WP_Error(
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
      $response_type = $request->get_param('response_type') ?? 'json';

      if (AniList_Utils::is_filter_empty($filter)) {
         return new WP_Error('rest_invalid_param', esc_html__('Filtros inválidos.'), ['status' => 400]);
      }

      $response = $this->media_api->get_filter($filter);

      if (empty($response)) {
         return new WP_Error('rest_invalid_param', esc_html__('Não foi encontrado nenhum resultado de acordo com o resultado da sua pesquisa.'), ['status' => 404]);
      }

      if ($response_type === 'html') {
         $html = '';

         ob_start();

         foreach ($response as $media) {
?>

            <li>
               <?php
               get_template_part('components/anime-card-vertical', null, [
                  'data' => $media,
               ]);
               ?>
            </li>

<?php
         }

         $html = ob_get_clean();

         return new WP_REST_Response($html, 200);
      }

      return new WP_Rest_Response($response, 200);
   }
}
