<?php
namespace Rocketeer\Plugins\OpenCloud;

use Rocketeer\Facades\Rocketeer;

class RocketeerOpenCloudServiceProvider extends ServiceProvider
{
  /*
   * Register classes
   *
   * @return void
   */
  public function register()
  {
  }

  /**
   * Boot the plugin
   *
   * @return void
   */
  public function boot()
  {
    Rocketeer::plugin('Rocketeer\Plugins\OpenCloud\RocketeerOpenCloud');
  }
}

?>
