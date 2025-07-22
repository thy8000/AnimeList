<?php

use AnimeList\Services\Anime\Anime;

get_template_part('public/components/header/_index', null, [
   'x-data' => 'virtualPageAnime'
]);

$Anime = new Anime((int) get_query_var('anime_ID'));

?>

<section class="mt-20">
   <div class="custom-container">
      <div class="flex lg:flex-row flex-col gap-8">
         <div class="lg:basis-1/4">
            <div>
               <picture>
                  <img class="aspect-[2/0] object-cover h-96" src="<?php echo esc_url($Anime->get_image()); ?>">
               </picture>
            </div>

            <div class="mt-8 flex flex-col lg:hidden">
               <h1 class="text-3xl font-poppins font-semibold text-green-500">
                  <?php echo esc_html($Anime->get_title('romaji')); ?>
               </h1>

               <span class="mt-1 text-xl font-semibold text-white">
                  <?php echo esc_html($Anime->get_title('native')); ?>
               </span>

               <span class="mt-4 self-start bg-green-500 rounded-lg py-1 px-2 text-white text-sm">
                  <?php echo esc_html($Anime->get_type()); ?>
               </span>
            </div>
            <?php

            $additional_info = $Anime->get_additional_info();

            if (!empty($additional_info)) {

            ?>
               <div class="flex flex-col mt-8 text-white bg-neutral-800 rounded-lg p-4">
                  <h2 class="text-xl font-semibold text-green-500">Informações adicionais</h2>

                  <div class="flex flex-col gap-2 mt-4">
                     <?php

                     foreach ($additional_info as $info) {
                        if (empty($info['data'])) {
                           continue;
                        }

                     ?>
                        <div class="flex flex-col gap text-white">
                           <b><?php echo $info['title']; ?></b>

                           <span><?php echo $info['data']; ?></span>
                        </div>
                     <?php

                     }

                     ?>
                  </div>
               </div>
            <?php

            }

            $tags = $Anime->get_tags();

            if (!empty($tags)) {

            ?>
               <div class="mt-8 text-white">
                  <h2 class="text-xl font-semibold text-green-500">Tags</h2>

                  <div class="flex flex-col gap-4 mt-4">
                     <?php

                     foreach ($tags as $key => $tag) {
                        $tooltip_key = "tooltip_{$key}";
                     ?>
                        <div x-data="{<?php echo esc_attr($tooltip_key); ?>: false}" x-on:mouseover="<?php echo esc_attr($tooltip_key); ?> = true" x-on:mouseleave="<?php echo esc_attr($tooltip_key); ?> = false" class="relative flex justify-between text-white bg-neutral-800 rounded-lg p-3">
                           <span><?php echo $tag['name']; ?></span>

                           <span><?php echo $tag['rank']; ?>%</span>
                           <!-- TODO: ARRUMAR TOOLTIP -->
                           <span x-show="<?php echo esc_attr($tooltip_key); ?>" class="absolute z-10 -top-[40px] left-2/4 -ml-[60px] bg-neutral-800 rounded-lg p-[5px] text-center after:content-[''] after:absolute after:-top-[15px] after:left-2/4 after:-ml-[5px] after:border-2 after:border-solid after:border-transparent after:border-t-neutral-800">
                              <?php echo $tag['description']; ?>
                           </span>
                        </div>
                     <?php

                     }

                     ?>
                  </div>
               </div>
            <?php

            }

            ?>
            <div class="mt-8">
               <h2 class="text-xl font-semibold text-green-500">Links externos</h2>

               <div class="flex flex-col gap-4 mt-4">
                  <div class="relative flex justify-end text-white bg-neutral-800 rounded-lg p-3">
                     <picture class="absolute top-0 left-0 flex items-center w-[15%] h-full bg-red-500 p-1 rounded-l-lg">
                        <img src="https://s4.anilist.co/file/anilistcdn/link/icon/13-ZwR1Xwgtyrwa.png">
                     </picture>

                     <span class="w-[75%]">Youtube</span>
                  </div>
               </div>
            </div>
         </div>

         <div class="flex flex-col lg:basis-3/4">
            <div class="hidden lg:flex flex-col">
               <h1 class="text-3xl font-poppins font-semibold text-green-500">
                  <?php echo esc_html($Anime->get_title('romaji')); ?>
               </h1>

               <span class="mt-1 text-xl font-semibold text-white">
                  <?php echo esc_html($Anime->get_title('native')); ?>
               </span>

               <span class="mt-4 self-start bg-green-500 rounded-lg py-1 px-2 text-white text-sm">
                  <?php echo esc_html($Anime->get_type()); ?>
               </span>
            </div>

            <div class="flex flex-col mt-8 text-white bg-neutral-800 rounded-lg p-4">
               <h2 class="text-xl font-semibold text-green-500">Sinopse</h2>

               <div class="mt-4 text-white">
                  <?php echo $Anime->get_description(); ?>
               </div>
            </div>

            <?php

            $related_animes = $Anime->get_relation();

            if (!empty($related_animes)) {
               get_template_part('public/pages/virtual-page-anime/components/anime-grid', null, [
                  'title'      => esc_html__('Relacionados', 'anime-list'),
                  'anime_list' => $related_animes,
               ]);
            }

            $recommended_animes = $Anime->get_recommended();

            if (!empty($recommended_animes)) {
               get_template_part('public/pages/virtual-page-anime/components/anime-grid', null, [
                  'title'             => esc_html__('Recomendados', 'anime-list'),
                  'anime_list'        => $recommended_animes,
               ]);
            }

            if (!empty($Anime->get_trailer())) {

            ?>
               <div class="flex flex-col mt-8 text-white bg-neutral-800 rounded-lg p-4">
                  <h2 class="text-xl font-semibold text-green-500">Trailer</h2>

                  <iframe class="mt-4 w-full aspect-video" src="<?php echo $Anime->get_trailer(); ?>" title="<?php echo esc_attr($Anime->get_title()); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
               </div>
            <?php

            }

            ?>
         </div>
      </div>
</section>

<?php

get_template_part('public/components/footer/_index');
