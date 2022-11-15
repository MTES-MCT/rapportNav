<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AuthenticationSuccess implements AuthenticationSuccessHandlerInterface {

    protected $router;

    public function __construct(RouterInterface $router) {
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse {
        $roles = $token->getUser()->getRoles();

        if(in_array('ROLE_PAM', $roles, true)) {
            return new RedirectResponse($this->router->generate('pam_rapport_dashboard', ['vueRouting' => null]));
        }

        return new RedirectResponse($this->router->generate('list_forms'));
    }
}
