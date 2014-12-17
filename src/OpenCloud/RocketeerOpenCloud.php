<?php
namespace Rocketeer\Plugins\OpenStack;

class RocketeerOpenStack extends AbstractPlugin
{

  private $client;

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
    $this->client =
      new Rackspace(Rackspace::US_IDENTITY_ENDPOINT, array(
                    'username' => $app['config']->get('rocketeer-opencloud::username'),
                    'apiKey' => $app['config']->get('rocketeer-opencloud::apiKey')
                  ));
       # $app['config']->get('rocketeer-opencloud::groupName');

    $app->bind('autoscale', function ($app) {
      return new AutoScaleServiceFacade($client, $app['config']->get('rocketeer-opencloud::region'));
    });
  }
}

?>
