<?php

if (!defined('ABSPATH')) {
   exit;
}

?>

<picture>
   <img class="<?php echo esc_attr($args['image_classes']); ?>" src="<?php echo esc_url($args['Anime']->get_image()); ?>">
</picture>

<div class="mt-4">
   <span class="text-sm text-green-500 font-semibold"><?php echo esc_html($args['anime_status']); ?></span>

   <span class="font-semibold line-clamp-2"><?php echo esc_html($args['Anime']->get_title()); ?></span>

   <span class="text-neutral-300 text-sm"><b>Status:</b> <?php echo esc_html($args['Anime']->get_status()); ?></span>
</div>
