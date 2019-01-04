<?php

// src/App/Document/Client.php

namespace App\Document;

use FOS\OAuthServerBundle\Document\Client as BaseClient;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Client
 * @package App\Document
 * @MongoDB\Document
 */
class Client extends BaseClient
{
    /**
     * @MongoDB\Id
     */
    protected $id;
}
