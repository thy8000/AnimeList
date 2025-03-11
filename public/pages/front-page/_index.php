<?php

use AnimeList\Services\AniList\Factory;

if (!defined('ABSPATH')) {
   exit;
}

get_template_part('public/components/header/_index');

$Anilist_Factory = new Factory();
$API = $Anilist_Factory->get_api();

$genres = $API->get_genres();

get_template_part('public/pages/front-page/components/header', null, [
   'genres' => $genres,
]);

get_template_part('public/components/footer/_index');
