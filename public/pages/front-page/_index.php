<?php

use AnimeList\Services\AniList\AniList;

if (!defined('ABSPATH')) {
   exit;
}

get_template_part('public/components/header/_index');

$AniList = new AniList();

$genres = $AniList->get_genres();
$trending_now = $AniList->get_trending_now();
$season_popular = $AniList->get_season_popular();
$upcoming_next_season = $AniList->get_upcoming_next_season();
$all_time_popular = $AniList->get_all_time_popular();

//TODO: Import Anime list page from thunay-moreira-de-soares-wp to this repo.
?>

<?php

get_template_part('public/components/footer/_index');
