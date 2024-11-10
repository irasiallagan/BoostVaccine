<?php
class App
{
  protected $controller = 'HomeController'; // Perbaikan default controller
  protected $method = 'index';
  protected $params = [];

  public function __construct()
  {
    $url = $this->parseUrl();

    // Jika URL kosong atau tidak ada controller yang ditentukan, gunakan default
    if ($url == null || !isset($url[0]) || $url[0] === "") {
      $url[0] = "Home";
    }

    // Cek apakah file controller yang diminta ada
    if (file_exists('../app/controllers/' . $url[0] . 'Controller.php')) {
      $this->controller = $url[0] . 'Controller';
      unset($url[0]);
    }

    // Pastikan file controller dapat dimuat
    require_once '../app/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    // Cek apakah method yang diminta ada di controller
    if (isset($url[1]) && method_exists($this->controller, $url[1])) {
      $this->method = $url[1];
      unset($url[1]);
    }

    // Tetapkan parameter atau gunakan array kosong jika tidak ada parameter
    $this->params = $url ? array_values($url) : [];

    // Panggil controller dan method dengan parameter yang ada
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  public function parseUrl()
  {
    if (isset($_GET['url'])) {
      return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
    }
    return null; // Kembalikan null jika URL tidak ada
  }
}
