<?php
namespace Rocketeer\Plugins\OpenCloud;

use Illuminate\Support\ServiceProvider;
use Rocketeer\Facades\Rocketeer;

/**
 * Register the OpenCloud plugin with the Laravel framework and Rocketeer
 */
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
