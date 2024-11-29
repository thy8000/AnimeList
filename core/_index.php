<?php

if (!defined('ABSPATH')) {
   exit;
}

require_once implode(DIRECTORY_SEPARATOR, [get_template_directory(), 'core', 'EnqueueScripts.php']);
require_once implode(DIRECTORY_SEPARATOR, [get_template_directory(), 'core', 'TemplateHierarchy.php']);
require_once implode(DIRECTORY_SEPARATOR, [get_template_directory(), 'core', 'ThemeSupport.php']);
require_once implode(DIRECTORY_SEPARATOR, [get_template_directory(), 'core', 'WPHead.php']);
