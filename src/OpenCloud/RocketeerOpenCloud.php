<?php
namespace Rocketeer\Plugins\OpenCloud;

use Illuminate\Container\Container;
use Illuminate\Support\Arr;
use Rocketeer\Abstracts\AbstractPlugin;
use Rocketeer\Services\TasksHandler;
use Rocketeer\Services\Connections\ConnectionsHandler;
use OpenCloud\Rackspace;

class ConnectionTest extends ConnectionsHandler
{
  public function __construct(Container $app)
  {
    parent::__construct($app);
  }

  public function getAvailableConnections()
  {
    // Fetch stored credentials
    $storage = (array) $this->localStorage->get('connections');

    // Merge with defaults from config file
    $configuration = (array) $this->config->get('rocketeer::connections');

    // Fetch from remote file
    $remote = (array) $this->config->get('remote.connections');

    // Merge configurations
    $connections = array_replace_recursive($remote, $configuration, $storage);

    // Unify multiservers
    foreach ($connections as $key => $servers) {
      $servers           = Arr::get($servers, 'servers', [$servers]);
      if (is_callable($servers)) {
      } else {
      }
      $connections[$key] = ['servers' => array_values(is_callable($servers) ? $servers() : $servers)];
    }

    return $connections;
  }
}

class RocketeerOpenCloud extends AbstractPlugin
{

  private $client;

  /**
   * Setup the plugin
   *
   * @param Container $app
   */
  public function __construct(Container $app)
  {
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
                    'username' => $app['config']->get('rocketeer-open-cloud::username'),
                    'apiKey' => $app['config']->get('rocketeer-open-cloud::api_key')
                  ));
       # $app['config']->get('rocketeer-open-cloud::groupName');

    $app->singleton('rocketeer.connections', function ($app) {
      return new ConnectionTest($app);
    });

    $app->bind('autoscale', function ($app) {
      return new AutoScaleServiceFacade($client, $app['config']->get('rocketeer-open-cloud::region'));
    });

    return $app;
  }

  /**
   *
   */
  public function onQueue(TasksHandler $queue)
  {
    // ...
  }
}

?>
