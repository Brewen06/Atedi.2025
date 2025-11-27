<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;

final class FlashMessageService
{
    public function __construct(private readonly RequestStack $requestStack)
    {
    }

    public function addSuccess(string $message): void
    {
        $this->add('success', $message);
    }

    public function addError(string $message): void
    {
        $this->add('danger', $message); // 'danger' est la classe par défaut pour les erreurs dans Bootstrap
    }

    public function addInfo(string $message): void
    {
        $this->add('info', $message);
    }

    private function add(string $type, string $message): void
    {
        /** @var FlashBagAwareSessionInterface $session */
        $session = $this->requestStack->getSession();
        $session->getFlashBag()->add($type, $message);
    }
}