<?php

namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\LogicException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

class TokenStorageDecorator extends TokenStorage
{
    protected static $decoratedToken = null;

    public function getToken()
    {
        return static::$decoratedToken ?: parent::getToken();
    }

    public function setToken(TokenInterface $token = null)
    {
        static::$decoratedToken = $token;

        parent::setToken($token);
    }

    public function setUser(UserInterface $user, string $tokenClass = UsernamePasswordToken::class)
    {
        if (static::$decoratedToken) {
            static::$decoratedToken->setUser($user);
        } else {
            static::getNewToken($user, $tokenClass);
        }

        $this->setToken(static::$decoratedToken);
    }

    public static function getNewToken(
        UserInterface $user,
        string $tokenClass = UsernamePasswordToken::class,
        string $firewall = 'firewall.main',
        array $credentials = []
    ): TokenInterface {
        switch ($tokenClass) {
            case PostAuthenticationGuardToken::class :
                static::$decoratedToken = new $tokenClass($user, $firewall, $user->getRoles());
                break;
            case UsernamePasswordToken::class :
                static::$decoratedToken = new $tokenClass($user, $credentials, $firewall, $user->getRoles());
                break;
            default:
                throw new LogicException(sprintf('The token %s is not supported', $tokenClass));
        }

        return static::$decoratedToken;
    }
}
