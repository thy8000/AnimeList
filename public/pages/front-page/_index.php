<?php

use AnimeList\Services\Anime\AnilistFactory;

if (!defined('ABSPATH')) {
   exit;
}

get_template_part('public/components/header/_index');

$AnilistFactory = new AnilistFactory();
$Anilist = $AnilistFactory->get_api();

?>

<?php

get_template_part('public/components/footer/_index');
