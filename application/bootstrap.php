<?php

// bootstrap

require 'core/ClassLoader.php';

// we often use controller, model dir..
$loader = new ClassLoader();
$loader->registerDir(dirname(__FILE__). '/core');
$loader->registerDir(dirname(__FILE__). '/models');
$loader->register();
/*
  notes
  dirname
  __FILE__
*/