<?php

if (!defined('ABSPATH')) {
   exit;
}

if (!empty($args['label'])) {

?>
   <label class="font-semibold text-white" for="<?php esc_attr_e($args['id']); ?>">
      <?php esc_html_e($args['label']); ?>
   </label>
<?php

}

?>

<div class="bg-slate-200 shadow-inner shadow-slate-200 rounded p-2">
   <input class="bg-transparent border-transparent outline-none text-gray-700" type="text" id="<?php esc_attr_e($args['id']); ?>" name="<?php esc_attr_e($args['name']); ?>" <?php esc_html_e($args['attrs']); ?>>
</div>
