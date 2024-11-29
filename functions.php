<?php

if (!defined('ABSPATH')) {
   exit;
}

require_once implode(DIRECTORY_SEPARATOR, [get_template_directory(), 'core', '_index.php']);
require_once implode(DIRECTORY_SEPARATOR, [get_template_directory(), 'utils', 'debug.php']);

new AnimeList\Core\EnqueueScripts();
new AnimeList\Core\TemplateHierarchy();
new AnimeList\Core\ThemeSupport();
new AnimeList\Core\WPHead();