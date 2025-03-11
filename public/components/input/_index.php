<?php

if (!defined('ABSPATH')) {
   exit;
}

if (empty($args) || empty($args['id'])) {
   return;
}

$type = $args['type'] ?? 'text';
$id = $args['id'];
$name = $args['name'] ?? $id;
$label = $args['label'] ?? $args['label'];

if ($type === 'select') {
   $options = $args['options'] ?? [];

   unset($args['options']);
}

unset($args['type']);
unset($args['name']);
unset($args['id']);
unset($args['label']);

$attrs = '';

foreach ($args as $key => $value) {
   $attrs .= ' ' . $key . '=' . $value . '';
}

if ($type === 'select') {
   get_template_part('public/components/input/components/select', null, [
      'id'   => $id,
      'name' => $name,
      'label' => $label,
      'attrs' => $attrs,
      'options' => $options,
   ]);
} else {
   get_template_part('public/components/input/components/text', null, [
      'id'   => $id,
      'name' => $name,
      'label' => $label,
      'attrs' => $attrs,
   ]);
}
