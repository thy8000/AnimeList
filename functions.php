<?php

if (!defined('ABSPATH')) {
   exit;
}

require_once __DIR__ . '/vendor/autoload.php';

require_once get_template_directory() . '/utils/load-files.php';
require_once get_template_directory() . '/utils/debug.php';


new AnimeList\Core\EnqueueScripts();
new AnimeList\Core\TemplateHierarchy();
new AnimeList\Core\ThemeSupport();
new AnimeList\Core\WPHead();
