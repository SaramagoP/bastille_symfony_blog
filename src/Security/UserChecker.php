<?php

namespace App\Security;


use App\Entity\User;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof User) { // si l'email n'est pas connu dans base de donnée,
            return; // on arrête le script
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {
            return;
        }

        // user account is expired, the user may be notified
        if (!$user->isVerified()) { // si l'user na pas vérifier sont compte, on affiche le message:  
            throw new CustomUserMessageAccountStatusException('Veuillez vérifier votre compte par email avant de vous connecter.');
        }
    }
}