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
                  <?php echo esc_html($Anime->get_title('english')); ?>
               </h1>

               <span class="mt-1 text-xl font-semibold text-white">
                  <?php echo esc_html($Anime->get_title('native')); ?>
               </span>

               <span class="mt-4 self-start bg-green-500 rounded-lg py-1 px-2 text-white text-sm">
                  <?php echo esc_html($Anime->get_type()); ?>
               </span>
            </div>

            <div class="flex flex-col mt-8 text-white bg-neutral-800 rounded-lg p-4">
               <h2 class="text-xl font-semibold text-green-500">Informações adicionais</h2>

               <div class="flex flex-col gap-2 mt-4">
                  <div class="flex flex-col gap text-white">
                     <b>Status</b>

                     <span>Completo</span>
                  </div>

                  <div class="flex flex-col gap text-white">
                     <b>Episódios/Capítulos</b>

                     <span>220</span>
                  </div>

                  <div class="flex flex-col gap text-white">
                     <b>Data de lançamento</b>

                     <span>20 de outubro de 2024</span>
                  </div>
               </div>
            </div>

            <div class="mt-8 text-white">
               <h2 class="text-xl font-semibold text-green-500">Tags</h2>

               <div class="flex flex-col gap-4 mt-4">
                  <div class="flex justify-between text-white bg-neutral-800 rounded-lg p-3">
                     <span>Tag</span>

                     <span>100%</span>
                  </div>

                  <div class="flex justify-between text-white bg-neutral-800 rounded-lg p-3">
                     <span>Tag</span>

                     <span>100%</span>
                  </div>

                  <div class="flex justify-between text-white bg-neutral-800 rounded-lg p-3">
                     <span>Tag</span>

                     <span>100%</span>
                  </div>

                  <div class="flex justify-between text-white bg-neutral-800 rounded-lg p-3">
                     <span>Tag</span>

                     <span>100%</span>
                  </div>

                  <div class="flex justify-between text-white bg-neutral-800 rounded-lg p-3">
                     <span>Tag</span>

                     <span>100%</span>
                  </div>
               </div>
            </div>

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
                  <?php echo esc_html($Anime->get_title('english')); ?>
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
                  Diablo Volpir, a powerful dark mage, was defeated and sealed away in a battle against the 12 gods. He finally wakes up from his sleep 66,666 years later, however, in the body of a newborn baby, Jamie Welton! 9 years later, with a fraction of power he once held and with the loving family and peaceful environment he is now surrounded by, Jamie plans to exact revenge against the 12 gods that had sealed him away.
               </div>
            </div>

            <div class="flex flex-col mt-8 text-white bg-neutral-800 rounded-lg p-4">
               <h2 class="text-xl font-semibold text-green-500">Relacionado</h2>

               Lista de relacionados
            </div>

            <div class="flex flex-col mt-8 text-white bg-neutral-800 rounded-lg p-4">
               <h2 class="text-xl font-semibold text-green-500">Recomendado</h2>

               Lista de recomendados
            </div>

            <div class="flex flex-col mt-8 text-white bg-neutral-800 rounded-lg p-4">
               <h2 class="text-xl font-semibold text-green-500">Trailer</h2>

               <iframe class="mt-4 w-full aspect-video" src="https://www.youtube.com/embed/8PxRJB3NPRQ" title="「この素晴らしい世界に祝福を！」同梱版ＣＭ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
         </div>
      </div>
</section>

<?php

get_template_part('public/components/footer/_index');
