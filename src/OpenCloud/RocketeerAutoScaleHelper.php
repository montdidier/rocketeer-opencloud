<?php
namespace Rocketeer\Plugins\OpenCloud;

use OpenCloud\Rackspace;
use OpenCloud\AutoscaleService;
use OpenCloud\ComputeService;

class RocketeerAutoScaleHelper
{
  private $config;

  private $client;

  private $autoscaleService;

  private $computeService;

  public function __construct()
  {
    $this->config = RocketeerOpenCloudConfiguration::instantiate();
    $this->client =
      new Rackspace(Rackspace::US_IDENTITY_ENDPOINT, array(
                    'username' => $this->config->username,
                    'apiKey' => $this->config->api_key
                  ));
    $this->autoscaleService = $this->client->autoscaleService(null, $this->config->region);
    $this->computeService = $this->client->computeService(null, $this->config->region);
  }

  public function addresses($username, $agent)
  {
    $groupList = $this->autoscaleService->groupList();

    $addresses = array();
    while($group = $groupList->next()) {
      foreach($group->getState()->active as $active) {
        if ($group->getState()->name == $this->config->autoscale_group) {
          $server = $this->computeService->server($active->id);
          array_push($addresses, array(
            'host' => $server->addresses->private[0]->addr,
            'username' => $username,
            'agent' => $agent,
            'agent-forward' => true,
            'db_role' => true
          ));
        }
      }
    }

    return $addresses;
  }
}

?>
