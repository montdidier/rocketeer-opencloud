<?php
namespace Rocketeer\Plugins\OpenStack;

use Rocketeer\Facades\Rocketeer;

class RocketeerOpenStackServiceProvider extends ServiceProvider
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
    Rocketeer::plugin('Rocketeer\Plugins\OpenStack\RocketeerOpenStack');
  }
}

?>
