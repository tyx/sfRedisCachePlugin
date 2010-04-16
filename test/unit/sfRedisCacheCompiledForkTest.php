<?php

require_once(dirname(__FILE__).'/../bootstrap/unit.php');

$plan = 60;
$t = new lime_test($plan, new lime_output_color());

try
{
  new sfRedisCache(array('mode' => 'compiled', 'keys_method' => 'getKeys'));
}
catch (sfInitializationException $e)
{
  $t->skip($e->getMessage(), $plan);
  return;
}

require_once(dirname(__FILE__).'/sfCacheDriverTests.class.php');

// setup
sfConfig::set('sf_logging_enabled', false);

// ->initialize()
$t->diag('->initialize()');
$cache = new sfRedisCache(array('mode' => 'compiled', 'keys_method' => 'getKeys'));
$cache->initialize(array('keys_method' => 'getKeys'));

sfCacheDriverTests::launch($t, $cache);