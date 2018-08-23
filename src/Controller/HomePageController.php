<?php
/**
 * Created by PhpStorm.
 * User: pusty
 * Date: 23.08.2018
 * Time: 21:25
 */

namespace App\Controller;
use App\Service\HomePageService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomePageController
 * @package App\Controller
 */
class HomePageController extends Controller
{
    /**
     * @Route("/", name="homePage")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function homePage(){

        return $this->render(
            'pages/homepage.html.twig',
            array(
                'domain'        => $this->getParameter('domain'),
            )
        );
    }

}