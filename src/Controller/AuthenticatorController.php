<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthenticatorController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();

        $username = json_decode($request->getContent())->username;
        $email = json_decode($request->getContent())->email;
        $password = json_decode($request->getContent())->password;
        $nom = json_decode($request->getContent())->nom;
        $prenom = json_decode($request->getContent())->prenom;
        $numTelephone = json_decode($request->getContent())->numTelephone;
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setNumTelephone($numTelephone);
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($encoder->encodePassword($user, $password));
        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }

    public function api()
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }

    public function getCompleteUser() {
        return $this->json($this->getUser());
    }
}