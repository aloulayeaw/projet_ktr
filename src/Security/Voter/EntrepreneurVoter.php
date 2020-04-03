<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class EntrepreneurVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['EDIT', 'DELETE'])
            && $subject instanceof \App\Entity\Entrepreneur;
    }

    protected function voteOnAttribute($attribute, $Entrepreneur, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        
        if (null == $Entrepreneur ->getUser()) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'POST_EDIT':
                return $Entrepreneur->getUser()->getId == $user ->getId();
                break;
            case 'POST_DELETE':
                return $Entrepreneur->getUser()->getId == $user ->getId();
                break;
        }

        return false;
    }
}
