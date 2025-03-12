<?php

use AnimeList\Services\AniList\Factory;

if (!defined('ABSPATH')) {
   exit;
}

get_template_part('public/components/header/_index');

$Anilist_Factory = new Factory();
$API = $Anilist_Factory->get_api();

$genres = $API->get_genres();
$oldest_anime = $API->get_oldest_anime();
$seasons = $API->get_seasons();
$formats = $API->get_formats();

get_template_part('public/pages/front-page/components/header', null, [
   'genres'       => $genres,
   'oldest_anime' => $oldest_anime,
   'seasons'      => $seasons,
   'formats'      => $formats,
]);

get_template_part('public/components/footer/_index');
