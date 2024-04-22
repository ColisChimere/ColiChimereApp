<?php

namespace App\Controller;

use App\Entity\Historisation;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setTypeUser('U');

            $entityManager->persist($user);
            $entityManager->flush();
            


            // Envoi de l'email de bienvenue
            $email = (new Email())
                ->from('fdagoreau@email.com')
                ->to($user->getEmail())
                ->subject('Bienvenue sur notre site')
                ->html($this->renderView('registration/welcome.html.twig', ['user' => $user])); 

            $mailer->send($email);

            // HIstorisation de l'e-mail envoyé

            $this->historiseEmail('Bienvenue sur notre site', $user, new \DateTime());

            
            

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    private function historiseEmail(string $objet, User $user, \DateTimeInterface $dateEnvoi): void
    {
        $historisation = new Historisation();
        $historisation->setObjet($objet);
        $historisation->setMailUser($user);
        $historisation->setDateEnvoi($dateEnvoi);

        $this->entityManager->persist($historisation);
        $this->entityManager->flush();
    }
}
