<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{
    public function showLogin()
    {
        return $this->twig->render('Admin/login.html.twig');
    }

    public function connectionAdmin()
    {
        $adminManager = new AdminManager();
        $admin = $adminManager->selectUserAdmin();

        if (isset($_POST['username']) && isset($_POST['password'])) {
            $errors = [];

            $username = $_POST['username'];
            $password = $_POST['password'];

            $username = htmlspecialchars(trim($username));
            $password = trim($password);

            if (empty($username)) {
                $errors[] = "Veuillez renseigner votre mail !";
            }

            if (empty($password)) {
                $errors[] = "Veuillez renseigner un mot de passe !";
            } elseif ($admin['username'] != $_POST["username"] || $admin['password'] != $_POST["password"]) {
                $errors[] = "Votre nom d'utilisateur ou votre mot de passe ne correspondent pas";
            }

            if (empty($errors)) {
                $_SESSION['username'] = $admin['username'];
                $_SESSION['password'] = $admin['password'];
                return $this->twig->render('Admin/panel.html.twig');
            } else {
                return $this->twig->render('Admin/login.html.twig', ['errors' => $errors]);
            }
        }
    }
}
