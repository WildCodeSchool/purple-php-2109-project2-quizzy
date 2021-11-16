<?php

namespace App\Controller;

use App\Model\AdminManager;
use App\Model\QuestionManager;

class AdminController extends AbstractController
{
    public function showLogin()
    {
        $adminManager = new AdminManager();
        $admin = $adminManager->selectUserAdmin();
        $errors = [];

        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $username = htmlspecialchars(trim($username));
            $password = trim($password);

            if (empty($username)) {
                $errors[] = "Veuillez renseigner votre mail !";
            }

            if (empty($password)) {
                $errors[] = "Veuillez renseigner un mot de passe !";
            }

            if ($admin['username'] != $_POST["username"] || $admin['password'] != $_POST["password"]) {
                $errors[] = "Votre nom d'utilisateur ou votre mot de passe ne correspondent pas";
            }

            if (empty($errors)) {
                $_SESSION['username'] = $admin['username'];
                $_SESSION['password'] = $admin['password'];

                header("location:/panel");
            }
        }
        return $this->twig->render('Admin/login.html.twig', ['errors' => $errors]);
    }

    public function showPanel()
    {
        $adminManager = new AdminManager();
        $adminManager->isAdminConnected();

        $questionManager = new QuestionManager();
        $questions = $questionManager->selectNonAdmittedQuestions();
        $questions = $adminManager->createArrayNonAdmittedQuestions($questions);

        return $this->twig->render('Admin/panel.html.twig', [
            'questions' => $questions,
        ]);
    }
}
