<?php

if (!defined('ABSPATH')) {
   exit;
}

function autoload($directory)
{
   $complete_path = get_template_directory() . '/' . $directory;

   if (!is_dir($complete_path)) {
      return;
   }

   $iterator = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($complete_path, RecursiveDirectoryIterator::SKIP_DOTS)
   );

   foreach ($iterator as $file) {
      if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
         include_once $file;
      }
   }
}
