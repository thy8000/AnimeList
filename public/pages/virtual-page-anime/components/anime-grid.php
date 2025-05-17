<?php

if (!defined('ABSPATH')) {
   exit;
}

use AnimeList\Services\Anime\Anime;

?>

<div class="flex flex-col mt-8 text-white bg-neutral-800 rounded-lg p-4">
   <h2 class="text-xl font-semibold text-green-500">
      <?php echo $args['title'] ?? esc_html__('Relacionados', 'anime-list'); ?>
   </h2>

   <?php

   if (!empty($args['anime_list'])) {

   ?>
      <ul class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-x-4 gap-y-8 mt-8">
         <?php

         foreach ($args['anime_list'] as $anime) {
            $Anime = new Anime($anime['node'] ?? $anime, $anime['relationType'] ?? null);

         ?>
            <li>
               <a href="<?php echo esc_url($Anime->get_link()); ?>">
                  <?php
                  // TODO: sanitize and capitalize anime status

                  // TODO: put see all

                  get_template_part('public/components/anime-card-horizontal', null, [
                     'Anime' => $Anime,
                     'image_classes' => 'w-full lg:h-[230px] h-[350px] rounded-lg object-cover',
                  ]);

                  ?>
               </a>
            </li>
         <?php

         }

         ?>
      </ul>
   <?php

   }

   ?>
</div>
