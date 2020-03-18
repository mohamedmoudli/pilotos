<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use OAuth2\OAuth2;
use Symfony\Bridge\Doctrine\Messenger\DoctrineClearEntityManagerWorkerSubscriber;
use Symfony\Component\HttpFoundation\Request;

class UserManager
{
    private $entityManager;
    private $oauth;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getUserByEmail($email){
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        return $user;
    }


}