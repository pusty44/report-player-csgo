<?php
/**
 * Created by PhpStorm.
 * User: pusty
 * Date: 23.08.2018
 * Time: 21:39
 */

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ReportsController
 * @package App\Controller
 */
class ReportsController extends Controller
{
    /**
     * @Route("/reports/list", name="reportsList")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function reportsList(){

        return $this->render(
            'pages/homepage.html.twig',
            array(
                'domain'        => $this->getParameter('domain'),
            )
        );
    }
}