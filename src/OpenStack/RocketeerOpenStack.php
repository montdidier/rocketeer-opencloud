<?php
namespace Rocketeer\Plugins\OpenStack;

class RocketeerOpenStack extends AbstractNotifier
{
  /**
   * Setup the plugin
   *
   * @param Container $app
   */
  public function __construct(Container $app)
  {
    parent:__construct($app);

    $this->configurationFolder = __DIR__ . '/../config';
  }

  /**
   * Bind additional classes to the Container
   *
   * @param Container $app
   *
   * @return void
   */
  public function register(Container $app)
  {
    $app->bind('opencloud', function ($app) {
      return null;
    });
  }
}

?>
