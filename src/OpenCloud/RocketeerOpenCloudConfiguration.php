<?php
namespace Rocketeer\Plugins\OpenCloud;

class ConfigInstance
{
  public $username;
  public $api_key;
  public $region;
  public $autoscale_group;

  /**
   */
  public function __construct($username, $api_key, $region, $autoscale_group)
  {
    $this->username = $username;
    $this->api_key = $api_key;
    $this->region = $region;
    $this->autoscale_group = $autoscale_group;
  }
}

class RocketeerOpenCloudConfiguration
{
  static public $username;

  static public $api_key;

  static public $region;

  static public $autoscale_group;

  /**
   */
  static public function instantiate()
  {
    return new ConfigInstance(self::$username, self::$api_key, self::$region, self::$autoscale_group);
  }
}

?>
