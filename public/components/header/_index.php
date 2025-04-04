<?php

if (!defined('ABSPATH')) {
   exit;
}

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
   <?php

   wp_head();

   ?>
</head>

<body <?php body_class("bg-neutral-900"); ?>>
   <?php

   wp_body_open();

   ?>

   <header id="header" class="fixed top-0 left-0 w-full z-10 bg-neutral-800 border-b-2 border-green-500" x-data="header">
      <div class="custom-container fade-in-3 transition duration-[3500ms] relative z-50">
         <div class="flex justify-between items-center py-4">
            <h1 class="text-white text-lg font-poppins">
               <?php echo get_bloginfo(); ?>
            </h1>
         </div>
      </div>
   </header>

   <main x-data="<?php echo esc_attr($args['x-data'] ?? ''); ?>">
