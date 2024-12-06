<?php

namespace AnimeList\Services;

if (!defined('ABSPATH')) {
   exit;
}

class Request
{
   public $response;
   private $request;
   private $error;
   private $headers = [];

   public function __construct()
   {
      $this->request = curl_init();

      $this->set_options();
   }

   private function set_options()
   {
      curl_setopt($this->request, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($this->request, CURLOPT_RETURNTRANSFER, 1);

      $this->headers[] = 'Content-Type: application/json';
   }

   public function get(string $url, array $headers = [], array $params = [])
   {
      if (!empty($params)) {
         $url .= '?' . http_build_query($params);
      }

      curl_setopt($this->request, CURLOPT_URL, $url);
      curl_setopt($this->request, CURLOPT_HTTPGET, true);

      if (!empty($headers)) {
         curl_setopt($this->request, CURLOPT_HTTPHEADER, $headers);
      }

      $this->execute();

      return $this->response;
   }

   public function post(string $url, array $data = [], array $headers = [], array $params = [])
   {
      if (!empty($params)) {
         $url .= '?' . http_build_query($params);
      }

      curl_setopt($this->request, CURLOPT_URL, $url);
      curl_setopt($this->request, CURLOPT_POST, true);
      curl_setopt($this->request, CURLOPT_POSTFIELDS, http_build_query($data));

      if (!empty($headers)) {
         curl_setopt($this->request, CURLOPT_HTTPHEADER, $headers);
      }

      $this->execute();

      return $this->response;
   }

   private function execute()
   {
      $this->response = curl_exec($this->request);

      $this->error = curl_error($this->request);

      if ($this->error) {
         throw new Exception("Erro ao fazer request: {$this->error}");
      }

      $this->response = json_decode($this->response, true);
   }

   public function __destruct()
   {
      curl_close($this->request);
   }
}
