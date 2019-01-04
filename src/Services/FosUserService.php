<?php

namespace App\Services;

use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\Response;

class FosUserService {

    public  $container;
    public  $document;

    public function __construct(Container $container, DocumentManager $document)
    {
        $this->container = $container;
        $this->document = $document;
    }

    public function checkUser($data) {

        $user_manager = $this->container->get('fos_user.user_manager');
        $user = $user_manager->findUserByUsername($data['username']);

        if($user instanceof User) {
            return ['succes'=> [$user]];
        } else {
            return [
                'error' => [
                    'message'=> 'user not found ' ,
                    "code"=> Response::HTTP_INTERNAL_SERVER_ERROR
                ]
            ];
        }

    }
}