<?php

// Request

// isPost
// getGet, getPost
// getHost
// isSsl
// getRequestUri

class Request
{
  public function isPost()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
      return true;
    }
    return false;
  }

  // default value is returned if the parameter doesn't exist
  public function getGet($name, $default = null)
  {
    if (isset($_GET[$name])){
      return $_GET[$name];
    }
    return $default;
  }
  public function getPost($name, $default = null)
  {
    if (isset($_POST[$name])){
      return $_POST[$name];
    }
    return $default;
  }

  public function getHost()
  {
    if (!empty($_SERVER['HTTP_HOST'])){
      return $_SERVER['HTTP_HOST'];
    }
  }
  public function isSsl()
  {
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
      return true;
    }
    return false;
  }
  public function getRequestUri()
  {
    return $_SERVER['REQUEST_URI'];
  }
  
  // get baseurl(path before basename), pathinfo
  // from request_uri(uri full string)
  
  // [baseurl]/[script_filename]/[path_info]
  // sometimes script_filename is omitted by .haccess.
  // [baseurl]/[path_info]
  public function getBaseUrl()
  {
    $script_name = $_SERVER['SCRIPT_NAME'];
    $request_uri = $this->getRequestUri();
    
    if (0 === strpos($request_uri, $script_name)){
      return $script_name;
    }else if(0 === strpos($request_uri, dirname($script_name))){
      return rtrim(dirname($script_name), '/');
    }
  }
  public function getPathInfo()
  {
    $base_url = $this->getBaseUrl();
    $request_uri = $this->getRequestUri();
    
    // a)example.jp/webapp/index.php/myaction?foo=bar
    // b)example.jp/webapp/index.php/myaction
    // (index.php may be omitted with RewriteEngine settings)
    //   --> in each case, path_info should be '/myaction'
    
    // cut '?foo=bar' from request_uri if exists
    if (false !== ($pos = strpos($request_uri, '?'))){
      $request_uri = substr($request_uri, 0, $pos);
    }
    // 
    $path_info = (string)substr($request_uri, strlen($base_url));
    return $path_info;
  }
  
}