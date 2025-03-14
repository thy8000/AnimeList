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

$genres = $API->get_genres();
$oldest_anime = $API->get_oldest_anime();
$seasons = $API->get_seasons();
$formats = $API->get_formats();

$content_data = [
   'trending_now'         => $API->get_trending_now(),
   'popular_this_season'  => $API->get_season_popular(),
   'upcoming_next_season' => $API->get_upcoming_next_season(),
   'all_time_popular'     => $API->get_all_time_popular()
];

get_template_part('public/pages/front-page/components/header', null, [
   'genres'       => $genres,
   'oldest_anime' => $oldest_anime,
   'seasons'      => $seasons,
   'formats'      => $formats,
]);

get_template_part('public/pages/front-page/components/content', null, [
   'data' => $content_data
]);

get_template_part('public/components/footer/_index');
