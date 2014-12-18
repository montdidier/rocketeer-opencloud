<?php
namespace Rocketeer\Plugins\OpenCloud;

class ConfigurationInstance
{
  /**
   */
  public $username;

  /**
   */
  public $api_key;

  /**
   */
  public $region;

  /**
   */
  public function __construct($username, $api_key, $region)
  {
    $this->username = $username;
    $this->api_key = $api_key;
    $this->region = $region;
  }
}

class RocketeerOpenCloudConfiguration
{
  /**
   */
  static public $username;

  /**
   */
  static public $api_key;

  /**
   */
  static public $region;

  /**
   */
  static public function instantiate()
  {
    return new ConfigurationInstance(self::$username, self::$api_key, self::$region);
  }
}

?>
