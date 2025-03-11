<?php

namespace AnimeList\Services\GraphQL;

class QueryBuilder
{
   protected $query;

   public function __construct()
   {
      $this->reset();
   }

   public function reset()
   {
      $this->query = [];
   }

   public function set_query(string $name, array $fields = [])
   {
      $this->reset();

      $this->query['query'] = "query {$name}";

      if (!empty($fields)) {
         $parameters = [];

         foreach ($fields as $key => $field) {
            $parameters[] = "$key: $field";
         }

         $this->query['query'] .= "(" . implode(", ", $parameters) . ")";
      }

      return $this;
   }

   public function set_object(string $name, array $fields)
   {
      $this->query['object'] = $name;

      if (!empty($fields)) {
         $parameters = [];

         foreach ($fields as $key => $field) {
            $parameters[] = "$key: " . $this->format_value($field);
         }

         $this->query['object'] .= "(" . implode(", ", $parameters) . ")";
      }

      return $this;
   }

   public function set_field(string $name, array $fields)
   {
      $this->query['field'] = $name;

      if (!empty($fields)) {
         $parametros = [];

         foreach ($fields as $key => $field) {
            $parametros[] = "$key: " . $this->format_value($field);
         }

         $this->query['field'] .= "(" . implode(", ", $parametros) . ")";
      }

      return $this;
   }

   public function set_sub_fields(array $fields)
   {
      $this->query['sub_fields'] = '';

      foreach ($fields as $key => $field) {
         if (is_array($field)) {
            $this->query['sub_fields'] .= $key . " { " . implode(" ", $field) . " } ";
         } else {
            $this->query['sub_fields'] .= $field . " ";
         }
      }

      return $this;
   }

   public function build()
   {
      $query = '';
      $close_count = 0;

      if (!empty($this->query['query'])) {
         $query .= $this->query['query'] . " { ";
         $close_count++;
      }

      if (!empty($this->query['object'])) {
         $query .= $this->query['object'] . " { ";
         $close_count++;
      }

      if (!empty($this->query['field'])) {
         $query .= $this->query['field'] . " { ";
         $close_count++;
      }

      if (!empty($this->query['sub_fields'])) {
         $query .= $this->query['sub_fields'];
      }

      $query .= str_repeat(" } ", $close_count);

      return trim($query);
   }

   private function format_value($field)
   {
      if (!isset($field['value'])) {
         return 'null';
      }

      return ($field['type'] === 'String') ? '"' . addslashes($field['value']) . '"' : $field['value'];
   }
}
