<?php

if (!defined('ABSPATH')) {
   exit;
}

use AnimeList\Services\AniList\Factory;
use AnimeList\Services\AniList\Utils;

if (!empty($args['api'])) {
   $API = $args['api'];
} else {
   $Anilist_Factory = new Factory();
   $API = $Anilist_Factory->get_api();
}

$seasons = $API->get_seasons();
$formats = $API->get_formats();

?>

<section>
   <div class="custom-container">
      <div class="flex flex-col">
         <div class="flex justify-center items-center flex-col gap-4 mt-20 bg-neutral-800 p-10 rounded-lg border border-neutral-700 w-full">
            <h2 class="text-center text-3xl font-poppins font-semibold text-green-500">
               <?php echo !empty($args['title']) ? $args['title'] : esc_html__('Plataforma de lista de animes', 'thunay'); ?>
            </h2>
            <?php

            if (!empty($args['description'])) {

            ?>
               <h3 class="max-w-[30ch] text-center text-white text-lg leading-7">
                  <?php echo $args['description']; ?>
               </h3>
            <?php

            }

            ?>
         </div>

         <?php

         if (!empty($args['large_description'])) {

         ?>
            <div class="flex justify-center items-center flex-col gap-4 mt-10 bg-neutral-800 p-5 rounded-lg border border-neutral-700 w-full">
               <div class="flex flex-col gap-10">
                  <p class="text-center text-white text-sm leading-7">
                     <?php echo sprintf(esc_html__('%s: Este projeto é de caráter pessoal e não comercial, criado com o objetivo de aprendizado e como parte de um portfólio. Todas as informações sobre os animes são obtidas através da API do %s e serão mantidas na língua oficial da API e do site (inglês). Este site não tem fins lucrativos e não visa compartilhar informações de maneira abrangente, mas sim demonstrar habilidades técnicas e conhecimentos adquiridos. Agradecemos pela compreensão e pelo apoio!', 'thunay'), "<span class='font-semibold'>Importante</span>", "<a class='text-green-400 hover:text-green-500 transition duration-300 ease-in' href='https://anilist.co/' target='_blank')>AniList (anilist.co)</a>"); ?>
                  </p>

                  <p class="text-center text-white text-sm leading-7">
                     <?php echo sprintf(esc_html__('%s: This project is of a personal and non-commercial nature, created for learning purposes and as part of a portfolio. All information about the anime is obtained through the %s and will be kept in the official language of the API and website (English). This site is not for profit and does not aim to share information comprehensively, but rather to demonstrate technical skills and knowledge acquired. We appreciate your understanding and support!', 'thunay'), "<span class='font-semibold'>Important</span>", "<a class='text-green-400 hover:text-green-500 transition duration-300 ease-in' href='https://anilist.co/' target='_blank')>AniList (anilist.co)</a>"); ?>
                  </p>
               </div>
            </div>
         <?php

         }

         ?>
      </div>

      <div class="mt-20 flex flex-col lg:flex-row gap-4">
         <div class="flex flex-col gap-4 w-full">
            <?php

            get_template_part('public/components/input/_index', null, [
               'id'   => 'page-anime-list-search',
               'label' => __('Search', 'thunay'),
               'x-model' => 'filterMap.search',
               'x-on:keyup.debounce.700ms' => 'filter'
            ]);

            ?>
         </div>

         <div class="flex flex-col gap-4 w-full">
            <?php

            get_template_part('public/components/input/_index', null, [
               'id'   => 'page-anime-list-genre',
               'label' => __('Genre', 'thunay'),
               'type' => 'select',
               'options' => Utils::get_genres(),
               'x-model' => 'filterMap.genre',
               'x-on:change' => 'filter'
            ]);

            ?>
         </div>

         <div class="flex flex-col gap-4 w-full">
            <?php

            get_template_part('public/components/input/_index', null, [
               'id'   => 'page-anime-list-year',
               'label' => __('Year', 'thunay'),
               'type' => 'select',
               'options' => Utils::get_years($API->get_oldest_anime()[0]['startDate']['year'], date('Y') + 1),
               'x-model' => 'filterMap.seasonYear',
               'x-on:change' => 'filter'
            ]);

            ?>
         </div>

         <div class="flex flex-col gap-4 w-full">
            <?php

            get_template_part('public/components/input/_index', null, [
               'id'   => 'page-anime-list-season',
               'label' => __('Season', 'thunay'),
               'type' => 'select',
               'options' => Utils::get_seasons($seasons),
               'x-model' => 'filterMap.season',
               'x-on:change' => 'filter'
            ]);

            ?>
         </div>

         <div class="flex flex-col gap-4 w-full">
            <?php

            get_template_part('public/components/input/_index', null, [
               'id'   => 'page-anime-list-format',
               'label' => __('Format', 'thunay'),
               'type' => 'select',
               'options' => Utils::get_formats($formats),
               'x-model' => 'filterMap.format',
               'x-on:change' => 'filter'
            ]);

            ?>
         </div>
      </div>

      <div class="flex">
         <div class="flex gap-2 bg-green-500 mt-6 p-2 rounded" x-show="filterMap.search">
            <span>Search:</span>
            <span x-text="filterMap.search"></span>
         </div>
      </div>
   </div>
</section>
