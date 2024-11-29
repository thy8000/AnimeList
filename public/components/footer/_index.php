<?php

if (!defined('ABSPATH')) {
   exit;
}

?>

</main>

<footer id="footer" class="bg-neutral-800 mt-16">
   <div class="py-5">
      <div class="custom-container">
         <div class="flex justify-between items-center flex-col lg:flex-row gap-8 text-center lg:text-start">
            <div>
               <span class="text-lg font-poppins font-semibold text-green-500">
                  Anime List
               </span>
            </div>

            <div>
               <span class="text-base font-semibold text-white hover:text-green-500 transition-all duration-500 cursor-pointer" href="mailto:thunaymoreiradesoares@gmail.com">
                  <?php echo date('Y'); ?> AnimeList. Todos os direitos reservados.
               </span>
            </div>
         </div>
      </div>
   </div>
</footer>

<?php

wp_footer();

?>
</body>

</html>