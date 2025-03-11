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

<select class="p-2 bg-slate-200 rounded shadow-inner shadow-slate-200 text-gray-700 border-transparent outline-none" name="<?php esc_attr_e($args['name']); ?>" id="<?php esc_attr_e($args['id']); ?>" <?php esc_html_e($args['attrs']); ?>>
   <?php

   foreach ($args['options'] as $key => $value) {

   ?>
      <option value="<?php esc_attr_e($key); ?>"><?php esc_html_e($value); ?></option>
   <?php

   }

   ?>
</select>
