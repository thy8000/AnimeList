<?php

if (!defined('ABSPATH')) {
   exit;
}

?>

<div class="flex justify-between">
   <h3 class="text-lg font-semibold text-white font-poppins"><?php echo $args['title'] ?? esc_html__('Animes', 'thunay');; ?></h3>

   <a class="text-white hover:text-green-500 transition duration-300 ease-in" href="<?php echo $args['view_more_link'] ?? '#'; ?>">
      <?php esc_html_e('See all', 'thunay'); ?>
   </a>
</div>

<?php

if (empty($args['data'])) {
   return;
}

?>

<ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-16 lg:gap-10 mt-10">
   <?php

   foreach ($args['data'] as $data) {

   ?>
      <li>
         <?php

         get_template_part('public/components/anime-card-vertical', null, [
            'data' => $data,
         ]);

         ?>
      </li>
   <?php

   }

   ?>
</ul>
