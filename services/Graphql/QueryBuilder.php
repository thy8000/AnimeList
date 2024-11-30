<?php

namespace AnimeList\Services\Graphql;

if (!defined('ABSPATH')) {
   exit;
}

class GraphqlQueryBuilder
{
   protected $query;

   public function __construct()
   {
      $this->reset();
   }

   public function reset()
   {
      $this->query = new \stdClass();
   }

   public function set_query(string $name, array $fields = [])
   {
      $this->reset();

      $this->query->query = "query {$name} ";

      if (!empty($fields)) {
         $this->query->query .= "(";

         foreach ($fields as $key => $field) {
            $this->query->query .= "$key: $field, ";
         }

         $this->query->query .= ") ";
      }

      return $this;
   }

   public function set_object(string $name, array $fields)
   {
      $this->query->object = $name;

      if (!empty($fields)) {
         $this->query->object .= "(";

         foreach ($fields as $key => $field) {
            if (empty($field['type'])) {
               $this->query->object .= "$key: \"$field\", ";
            } else if ($field['type'] === 'String') {
               $field_value = $field['value'];

               $this->query->object .= "$key: \"$field_value\", ";
            } else {
               $field_value = $field['value'];

               $this->query->object .= "$key: $field_value, ";
            }
         }

         $this->query->object .= ") ";
      }

      return $this;
   }

   public function set_field(string $name, array $fields)
   {
      $this->query->field = $name;

      if (!empty($fields)) {
         $this->query->field .= "(";

         foreach ($fields as $key => $field) {
            if (empty($field['type']) || empty($field['value'])) {
               $this->query->field .= "$key: \"$field\", ";
            } else if ($field['type'] === 'String') {
               $field_value = $field['value'];

               $this->query->field .= "$key: \"$field_value\", ";
            } else {
               $field_value = $field['value'];

               $this->query->field .= "$key: $field_value, ";
            }
         }

         $this->query->field .= ") ";
      }

      return $this;
   }

   public function set_sub_fields(array $fields)
   {
      $this->query->sub_fields = "";

      foreach ($fields as $key => $field) {
         if (is_array($field)) {
            $this->query->sub_fields .= $key . " { ";

            foreach ($field as $sub_field) {
               $this->query->sub_fields .= $sub_field . " ";
            }

            $this->query->sub_fields .= " } ";
         } else {
            $this->query->sub_fields .= $field . " ";
         }
      }

      return $this;
   }

   public function build()
   {
      $query = null;
      $close_count = 0;

      if (!empty($this->query->query)) {
         $query .= $this->query->query . " { ";

         $close_count++;
      }

      if (!empty($this->query->object)) {
         $query .= $this->query->object . " { ";

         $close_count++;
      }

      if (!empty($this->query->field)) {
         $query .= $this->query->field . " { ";

         $close_count++;
      }

      if (!empty($this->query->sub_fields)) {
         $query .= $this->query->sub_fields;
      }

      if ($close_count > 0) {
         for ($i = 0; $i < $close_count; $i++) {
            $query .= " } ";
         }
      }

      return $query;
   }
}
