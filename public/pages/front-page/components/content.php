<?php

if (!defined('ABSPATH')) {
   exit;
}

?>

<div x-show="isLoading" class="spinner"></div>

<section class="py-10" x-show="isFilterEmpty">
   <div class="custom-container">
      <?php

      get_template_part('public/pages/front-page/components/animes-row', null, [
         'title' => __('Trending now', 'thunay'),
         'data'  => $args['data']['trending_now'],
      ]);

      ?>
   </div>
</section>

<section class="py-10" x-show="isFilterEmpty">
   <div class="custom-container">
      <?php

      get_template_part('public/pages/front-page/components/animes-row', null, [
         'title' => __('Popular this season', 'thunay'),
         'data'  => $args['data']['popular_this_season'],
      ]);

      ?>
   </div>
</section>

<section class="py-10" x-data="console.log(isFilterEmpty())" x-show="isFilterEmpty">
   <div class="custom-container">
      <?php

      get_template_part('public/pages/front-page/components/animes-row', null, [
         'title' => __('Upcoming next season', 'thunay'),
         'data'  => $args['data']['upcoming_next_season'],
      ]);

      ?>
   </div>
</section>

<section class="py-10" x-show="isFilterEmpty">
   <div class="custom-container">
      <?php

      get_template_part('public/pages/front-page/components/animes-row', null, [
         'title' => __('All time popular', 'thunay'),
         'data'  => $args['data']['all_time_popular'],
      ]);

      ?>
   </div>
</section>

<section class="py-10" x-show="searchValue">
   <div class="custom-container">
      <ul id="anime-list-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-16 lg:gap-10 mt-10"></ul>
   </div>
</section>
