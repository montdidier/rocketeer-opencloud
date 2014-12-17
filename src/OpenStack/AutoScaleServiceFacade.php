<?php
namespace Rocketeer\Plugins\OpenCloud;

use OpenCloud\Rackspace;
use OpenCloud\Autoscale;

class AutoScaleServiceFacade extends AbstractServiceFacade
{
  private $client;

  private $region;

  /**
   *
   */
  public function __construct($client, $region)
  {
    $this->client = $client;
    $this->region = $region;
  }

  /*
   *
   */
  public function service()
  {
    return $client->autoscaleService(null, $this->region);
  }

  /**
   *
   *
   */
  public function addresses($groupName)
  {
    $autoscaleService = $client->autoscaleService(null, $this->region);
    $computeService = $client->computeService(null, $this->region);
    $groupList = $autoscaleService->groupList();

    $addresses = array();

    while($group = $groupList->next()) {
      foreach($group->getState()->active as $active) {
        if ($group->getState()->name == $groupName)
          $server = $computeService->server($active->id);
          array_push($addresses, $server->addresses->private[0]->addr);
        }
      }
    }

    return $addresses;
  }
}

?>
