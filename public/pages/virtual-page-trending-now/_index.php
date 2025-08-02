<?php

use AnimeList\Services\AniList\Factory;

$Anilist_Factory = new Factory();
$API = $Anilist_Factory->get_api();

get_template_part('public/components/header/_index', null, [
   'x-data' => 'trendingNow'
]);

get_template_part('public/components/main-hero', null, [
   'api'          => $API,
   'title'        => esc_html__('Trending Now', 'thunay'),
]);

get_template_part('public/components/footer/_index');
