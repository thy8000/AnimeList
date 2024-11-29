<?php

if (!defined('ABSPATH')) {
   exit;
}

function debug($mixed)
{
   error_log(var_export($mixed, 1));

   return $mixed;
}
