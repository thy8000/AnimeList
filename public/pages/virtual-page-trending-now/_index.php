<?php

get_template_part('public/components/header/_index', null, [
   'x-data' => 'trendingNow'
]);

echo '<h1>Trending Now</h1>';

get_template_part('public/components/footer/_index');
