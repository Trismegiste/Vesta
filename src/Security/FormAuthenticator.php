<?php

/*
 * VirImmo
 */

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

/**
 * Description of FormAuthenticator
 *
 * @author flo
 */
class FormAuthenticator extends AbstractLoginFormAuthenticator
{

    //put your code here
    protected function getLoginUrl(Request $request): string
    {
        return '/login';
    }

    public function authenticate(Request $request): PassportInterface
    {

        $password = $request->request->get('password');
        $username = $request->request->get('username');
        $csrfToken = $request->request->get('csrf_token');

        // ... validate no parameter is empty

        return new Passport(
                new UserBadge($username),
                new PasswordCredentials($password),
                [new CsrfTokenBadge('authenticate', $csrfToken)]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return new \Symfony\Component\HttpFoundation\RedirectResponse('/');
    }

}
