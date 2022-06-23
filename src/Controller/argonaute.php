<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class argonaute extends AbstractController
{
    #[Route('/register', name: 'register', methods: ['GET', 'POST'])]
        public function register(Request $request, UserRepository $userRepository): Response
        {
            $user = new User();

            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid())
            {

                $userRepository->add($user);
            }
            $user = $userRepository->findBy([], ['name'=>'ASC']);
            return $this->render('register/register.html.twig', [
                'form'=>$form->createView(),
                'user'=>$user
            ]);
        }




}