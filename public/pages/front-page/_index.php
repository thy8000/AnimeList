<?php

use AnimeList\Services\AniList\Factory;

if (!defined('ABSPATH')) {
   exit;
}

get_template_part('public/components/header/_index', null, [
   'x-data' => 'frontPage'
]);

$Anilist_Factory = new Factory();
$API = $Anilist_Factory->get_api();

$content_data = [
   'trending_now'         => $API->get_trending_now(),
   'popular_this_season'  => $API->get_season_popular(),
   'upcoming_next_season' => $API->get_upcoming_next_season(),
   'all_time_popular'     => $API->get_all_time_popular()
];

get_template_part('public/components/main-hero', null, [
   'api'          => $API,
   'description'  => esc_html__('Explore, descubra e encontre seus animes e mangás favoritos.', 'thunay'),
   'large_description' => true,
]);

get_template_part('public/pages/front-page/components/content', null, [
   'data' => $content_data
]);

get_template_part('public/components/footer/_index');
