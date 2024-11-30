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
                  <?php echo get_bloginfo('name'); ?>
               </span>
            </div>

            <div>
               <span class="text-base font-semibold text-white hover:text-green-500 transition-all duration-500 cursor-pointer" href="mailto:thunaymoreiradesoares@gmail.com">
                  <?php

                  printf(
                     "%s - %s. %s",
                     date('Y'),
                     get_bloginfo(),
                     esc_html__('Todos os direitos reservados', 'animelist')
                  );

                  ?>.
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
