<?php

namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CustomerController extends AbstractController
{
    #[Route('/api/customers/{id}/user', name: 'app_new_user', methods: ['POST'])]
    public function __invoke($id, Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $customer = $em->getRepository(Customer::class)->find($id);
        $data = json_decode($request->getContent(), true);
        $user = new User;
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $password = $userPasswordHasher->hashPassword($user, $data['password']);
        $user->setPassword($password);
        $user->setCustomer($customer);
        $em->getRepository(User::class)->save($user, true);

        return new JsonResponse([
            'id'=>$user->getId(),
            'name'=>$user->getName(),
            'email'=>$user->getEmail(),
        ]);
    }
}
