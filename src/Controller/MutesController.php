<?php
/**
 * Created by PhpStorm.
 * User: pusty
 * Date: 23.08.2018
 * Time: 21:41
 */

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MutesController
 * @package App\Controller
 */

class MutesController extends Controller
{
    /**
     * @Route("/mutes/list", name="mutesList")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function mutesList(){

        return $this->render(
            'pages/homepage.html.twig',
            array(
                'domain'        => $this->getParameter('domain'),
            )
        );
    }

}