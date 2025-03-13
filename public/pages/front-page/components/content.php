<?php

if (!defined('ABSPATH')) {
   exit;
}

?>

<section class="py-10">
   <div class="custom-container">
      <?php

      get_template_part('public/pages/front-page/components/animes-row', null, [
         'title' => __('Trending now', 'thunay'),
         'data'  => $args['data']['trending_now'],
         'view_more_link' => esc_url('/trending-now/'),
      ]);

      ?>
   </div>
</section>

<section class="py-10">
   <div class="custom-container">
      <?php

      get_template_part('public/pages/front-page/components/animes-row', null, [
         'title' => __('Popular this season', 'thunay'),
         'data'  => $args['data']['popular_this_season'],
         'view_more_link' => esc_url('/popular-this-season/'),
      ]);

      ?>
   </div>
</section>

<section class="py-10">
   <div class="custom-container">
      <?php

      get_template_part('public/pages/front-page/components/animes-row', null, [
         'title' => __('Upcoming next season', 'thunay'),
         'data'  => $args['data']['upcoming_next_season'],
         'view_more_link' => esc_url('/upcoming-next-season/'),
      ]);

      ?>
   </div>
</section>

<section class="py-10">
   <div class="custom-container">
      <?php

      get_template_part('public/pages/front-page/components/animes-row', null, [
         'title' => __('All time popular', 'thunay'),
         'data'  => $args['data']['all_time_popular'],
         'view_more_link' => esc_url('/all-time-popular/'),
      ]);

      ?>
   </div>
</section>
