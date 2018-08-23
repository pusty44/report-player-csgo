<?php
/**
 * Created by PhpStorm.
 * User: pusty
 * Date: 05.08.2018
 * Time: 15:46
 */

namespace App\Service;


use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityService
{
    public function login(AuthenticationUtils $authenticationUtils) : array {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return[
            'error' => $error,
            'lastUsername' => $lastUsername
        ];
    }
}