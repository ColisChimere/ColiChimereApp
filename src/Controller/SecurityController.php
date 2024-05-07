<?php

namespace App\Controller;

use App\Entity\UserConnexion;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path:'/api/login')]
    public function apiLogin(
        Request $request,  
        UserRepository $userRepository, 
        UserPasswordHasherInterface $hasher,
        EntityManagerInterface $em
    ): JsonResponse
    {
        $req = json_decode($request->getContent(),false);
        $tokken = null;
        if($user = $userRepository->findOneBy(['email'=> $req->email]))
        {
            if($user->getPassword() == $hasher->hashPassword($user, $req->password))
            {
                $tokken = $user->CreateToken('api', 600);
                $em->persist($user);
                $em->flush();
            }
            else return $this->json(['message'=>'Mot de passe invalide'],401);
            
        }
        else return $this->json(['message'=>'Identifiant invalide'],401);

        return $this->json(['tokken'=>$tokken],200);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
