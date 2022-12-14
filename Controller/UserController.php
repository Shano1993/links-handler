<?php

namespace App\Controller;

use App\Model\Entity\User;
use App\Model\Manager\UserManager;
use App\Routing\AbstractRouter;

class UserController extends AbstractController
{
    public function index()
    {
        $this->render('home/index');
    }

    public function register()
    {
        if (AbstractController::userConnected()) {
            header('location: /index.php?c=home');
        }
        if ($this->isFormSubmitted()) {
            $username = trim($this->sanitizeString($this->getField('username')));
            $email = filter_var($this->getField('email'), FILTER_SANITIZE_EMAIL);
            $password = $this->getField('password');
            $passwordRepeat = $this->getField('passwordRepeat');

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['errors'] = "L'adresse email n'est pas au bon format.";
            }

            if (strlen($username) <= 2 || strlen($username) >= 45) {
                $_SESSION['errors'] = "Le pseudo doit contenir entre 2 et 45 caractères.";
            }

            if ($password !== $passwordRepeat) {
                $_SESSION['errors'] = "Les mots de passe ne correspondent pas.";
            }

            if (!preg_match('/^(?=.*[!@#$%^&*-\])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
                $_SESSION['errors'] = "Le mot de passe doit contenir une majuscule, un chiffre et un caractère special.";
            }

            else {
                $user = new User();
                $user
                    ->setUsername($username)
                    ->setEmail($email)
                    ->setPassword(password_hash($password, PASSWORD_DEFAULT))
                ;
            }

            if (!UserManager::mailUserExist($user->getEmail())) {
                if (!UserManager::usernameUserExist($user->getUsername())) {
                    UserManager::addUser($user);
                    $_SESSION['user'] = $user;
                    header('location: /index.php?c=home');
                }
            }
        }
        $this->render('user/register');
    }

    public function login()
    {
        if (self::userConnected()) {
            header('location: /index.php?c=home');
        }
        if ($this->isFormSubmitted()) {
            $email = $this->sanitizeString($this->getField('email'));
            $password = $this->getField('password');

            $user = UserManager::getUserByMail($email);
            if (null === $user) {
                header('location: /index.php?c=home');
            }
            else {
                if (password_verify($password, $user->getPassword())) {
                    $user->setPassword('');
                    $_SESSION['user'] = $user;
                    header('location: /index.php?c=home');
                }
            }
        }
        $this->render('user/login');
    }

    public function logout()
    {
        if (!self::userConnected()) {
            header('location: /index.php?c=home');
        }
        else {
            $_SESSION['user'] = null;
            session_destroy();
        }
        $this->index();
    }
}
