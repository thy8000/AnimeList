<?php

get_template_part('public/components/header/_index', null, [
   'x-data' => 'virtualPageAnime'
]);

// TODO: CRIAR SIDEBAR
?>

<section class="mt-20">
   <div class="custom-container">
      <div class="flex lg:flex-row flex-col gap-8">
         <div class="lg:basis-1/4">
            <picture>
               <img class="aspect-[2/0] h-96" src="https://s4.anilist.co/file/anilistcdn/media/manga/cover/large/bx137595-1m3i7vxyOqXc.png">
            </picture>
         </div>

         <div class="flex flex-col">
            <h1 class="text-3xl font-poppins font-semibold text-green-500">Naruto</h1>

            <span class="mt-1 text-xl font-semibold text-white">66666년만에 환생한 흑마법사</span>

            <span class="mt-4 self-start bg-green-500 rounded-lg py-1 px-2 text-white text-sm">
               Anime
            </span>

            <div class="flex flex-col mt-10 text-white">
               <span class="border-y border-neutral-700 border-solid py-2"><b>Status:</b> Completo</span>
               <span class="border-y border-neutral-700 border-solid py-2"><b>Episódios/Capítulos:</b> 220</span>
               <span class="border-y border-neutral-700 border-solid py-2"><b>Data de lançamento:</b> 20 de outubro de 2024</span>
               <span class="border-y border-neutral-700 border-solid py-2"><b>Estúdio/Autor:</b> Studio Pierrot</span>
               <span class="border-y border-neutral-700 border-solid py-2"><b>Gêneros:</b> Ação, Comédia, Hentai, Aventura</span>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="mt-8">
   <div class="custom-container">
      <h2 class="text-xl font-semibold text-green-500">Sinopse</h2>

      <div class="mt-4 text-white">
         Diablo Volpir, a powerful dark mage, was defeated and sealed away in a battle against the 12 gods. He finally wakes up from his sleep 66,666 years later, however, in the body of a newborn baby, Jamie Welton! 9 years later, with a fraction of power he once held and with the loving family and peaceful environment he is now surrounded by, Jamie plans to exact revenge against the 12 gods that had sealed him away.
      </div>
   </div>
</section>

<section class="mt-8">
   <div class="custom-container">
      <h2 class="text-xl font-semibold text-green-500">Tags</h2>

      <div class="mt-4 flex flex-wrap gap-4">
         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>

         <span class="self-start bg-green-500 rounded-lg py-1 px-4 text-white text-sm">
            Gods
         </span>
      </div>
   </div>
</section>

<section class="mt-8">
   <div class="custom-container">
      <h2 class="text-xl font-semibold text-green-500">Trailer</h2>

      <iframe class="mt-4 w-full aspect-video" src="https://www.youtube.com/embed/8PxRJB3NPRQ" title="「この素晴らしい世界に祝福を！」同梱版ＣＭ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
</section>

<section class="mt-8">
   <div class="custom-container">
      <h2 class="text-xl font-semibold text-green-500">Relacionado</h2>

      Lista de relacionados
   </div>
</section>

<section class="mt-8">
   <div class="custom-container">
      <h2 class="text-xl font-semibold text-green-500">Recomendado</h2>

      Lista de recomendados
   </div>
</section>

<?php

get_template_part('public/components/footer/_index');
