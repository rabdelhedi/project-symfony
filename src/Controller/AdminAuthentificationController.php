<?php

namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\View\View as RestView;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @FOSRest\Route("/")
 * Class AdminAuthentificationController
 * @package App\Controller
 */
class AdminAuthentificationController extends FOSRestController {


    /**
     * @FOSRest\Post("openapi/admin/authentification")
     * @FOSRest\View()
     */
    public function Authentification(Request $request) {

        $content = $request->getContent();
        $data = json_decode($content, true);

       //check parameter
       $parameterTocheck=  ['username', 'password'];
       $checkParameterResult= $this->checkParameter($data, $parameterTocheck);

       if (isset($checkParameterResult['error'])){
           return View::create($checkParameterResult, $checkParameterResult['error']['code']);
       } else {
           // check connexion

           $user = $this->get('fos_user_service')->checkUser($data);
           dump($user);die;

       }

     return $this->handleView($this->view('toto'));

    }

    /**
     * @param $data
     * @param $parameterToCheck
     */
    public function checkParameter($data, $parametersToCheck) {

        $result = [];
        foreach ($parametersToCheck as $param) {
            if (!isset($data[$param])) {
                $result = [
                    'error'=> [
                        'code' => Response::HTTP_BAD_REQUEST,
                        'status' => 'parameter_missing'
                    ]
                ];
            }

        }
        return $result;
    }


}