<?php

namespace App\EventSubscriber;

use Gedmo\Blameable\BlameableListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DoctrineExtensionSubscriber implements EventSubscriberInterface
{
    /**
     * @var BlameableListener
     */
    private $blameableListener;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    public function __construct(BlameableListener $blameableListener, TokenStorageInterface $tokenStorage) {
        $this->blameableListener = $blameableListener;
        $this->tokenStorage = $tokenStorage;
    }


    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
    public function onKernelRequest(): void
    {
        if ($this->tokenStorage !== null &&
            $this->tokenStorage->getToken() !== null &&
            $this->tokenStorage->getToken()->isAuthenticated() === true
        ) {
            $this->blameableListener->setUserValue($this->tokenStorage->getToken()->getUser());
        }
    }
}