<?php

/**
 * Dependency Checker
 */
class A2CBC_Dependencies
{

  private static $active_plugins;

  /**
   * @return void
   */
  public static function init()
  {
    self::$active_plugins = (array)get_option('active_plugins', array());

    if (is_multisite()) {
      self::$active_plugins = array_merge(self::$active_plugins, get_site_option('active_sitewide_plugins', array()));
    }
  }

  /**
   * @return bool
   */
  public static function required_plugins_active_check()
  {
    if (!self::$active_plugins) {
      self::init();
    }

    return in_array('woocommerce/woocommerce.php', self::$active_plugins) || array_key_exists('woocommerce/woocommerce.php', self::$active_plugins)
      || in_array('wp-e-commerce/wp-shopping-cart.php', self::$active_plugins) || array_key_exists('wp-e-commerce/wp-shopping-cart.php', self::$active_plugins);
  }

}