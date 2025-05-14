<?php

if (!defined('ABSPATH')) {
   exit;
}

$Anime = $args['Anime'];

?>

<picture>
   <img class="<?php echo esc_attr($args['image_classes']); ?>" src="<?php echo esc_url($Anime->get_image()); ?>">
</picture>

<div class="mt-4">
   <?php

   if (!empty($Anime->get_relation_type())) {

   ?>
      <span class="text-sm text-green-500 font-semibold"><?php echo esc_html($Anime->get_relation_type()); ?></span>
   <?php

   }

   ?>

   <span class="font-semibold line-clamp-2"><?php echo esc_html($Anime->get_title()); ?></span>
   <span class="text-neutral-300 text-sm"><b>Status:</b> <?php echo esc_html($Anime->get_status()); ?></span>
</div>
