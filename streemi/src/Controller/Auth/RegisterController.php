<?php

namespace App\Controller\Auth;

use App\Entity\User;
use App\Form\RegisterType;
use App\Enum\UserAccountStatusEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    private FormFactoryInterface $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        EntityManagerInterface $entityManager
    ): Response {
        // Redirige l'utilisateur connecté vers la page d'accueil
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        // Création d'un nouvel utilisateur
        $user = new User();
        $form = $this->formFactory->create(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hachage du mot de passe
            $plainPassword = $form->get('plainPassword')->getData();
            $user->setPassword($userPasswordHasher->hashPassword($user, $plainPassword));

            // Définition des rôles et du statut
            $user->setRoles(['ROLE_USER']);
            $user->setAccountStatus(UserAccountStatusEnum::ACTIVE);

            // Sauvegarde dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirection vers la page de connexion
            return $this->redirectToRoute('app_login');
        }

        // Rendu du formulaire d'inscription
        return $this->render('auth/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
