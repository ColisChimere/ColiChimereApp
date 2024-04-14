<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\ClientAdress;
use App\Entity\User;
use App\Entity\Ville;
use App\Form\RegistrationFormType;
use App\Form\DestinataireFormType;
use App\Form\AdresseType;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        UserAuthenticatorInterface $userAuthenticator, 
        UserAuthenticator $authenticator, 
        EntityManagerInterface $entityManager
    ): Response
    {
        $user = new User();
        $adr = new Adresse();
        $vill = new Ville();
        $form = $this->createForm(DestinataireFormType::class, [$user, $adr, $vill]);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('Register')->get('Password')->getData()
                )
            );
            $user->setTypeUser('U');

            $cliAdr = new ClientAdress();
            $cliAdr->setAdresse($adr);
            $cliAdr->setUser($user);
            $cliAdr->setTypeAdress('FL');

            $adr->setVille($vill);
            $adr->addClientAdress($cliAdr);
            $user->addClientAdress($cliAdr);

            $entityManager->persist($user);
            $entityManager->persist($adr);
            $entityManager->persist($vill);
            $entityManager->persist($cliAdr);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
