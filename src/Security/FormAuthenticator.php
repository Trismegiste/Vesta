<?php

/*
 * Vesta
 */

namespace App\Security;

use App\Form\LoginType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
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

    protected FormFactoryInterface $formFactory;

    public function __construct(FormFactoryInterface $fac)
    {
        $this->formFactory = $fac;
    }

    //put your code here
    protected function getLoginUrl(Request $request): string
    {
        return '/account/login';
    }

    public function authenticate(Request $request): PassportInterface
    {
        $form = $this->formFactory->create(LoginType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return new Passport(
                    new UserBadge($data['username']),
                    new PasswordCredentials($data['password'])
            );
        }

        throw new AuthenticationException();
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return new RedirectResponse('/');
    }

}
