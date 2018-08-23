<?php
/**
 * Created by PhpStorm.
 * User: pusty
 * Date: 23.08.2018
 * Time: 21:37
 */

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BansController
 * @package App\Controller
 */
class BansController extends Controller
{
    /**
     * @Route("/bans/list", name="bansList")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function bansList(){

        return $this->render(
            'pages/homepage.html.twig',
            array(
                'domain'        => $this->getParameter('domain'),
            )
        );
    }


}