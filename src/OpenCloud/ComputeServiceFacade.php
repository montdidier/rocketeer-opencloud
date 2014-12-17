<?php
namespace Rocketeer\Plugins\OpenCloud;

use OpenCloud\Rackspace;
use OpenCloud\Compute;

class ComputeServiceFacade extends AbstractServiceFacade
{
  private $client;

  private $region;

  /*
   *
   */
  public function __construct($client, $region)
  {
    $this->client = $client;
    $this->region = $region;
  }

  public function service()
  {
    return $client->computeService(null, $this->region);
  }
}

?>
