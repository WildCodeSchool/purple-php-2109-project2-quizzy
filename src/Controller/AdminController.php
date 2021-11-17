<?php

namespace App\Controller;

use App\Model\AdminManager;
use App\Model\QuestionManager;
use App\Model\AnswersManager;
use App\Model\ManagementManager;

class AdminController extends AbstractController
{
    public function showLogin()
    {
   /* Management of the connection, currently this only creates an admin session.
        Also currently there is no way to create an account so functions only account for that. */
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
        // This shows questions that are yet to be admitted.
        $adminManager = new AdminManager();
        $adminManager->isAdminConnected();

        $questionManager = new QuestionManager();
        $questions = $questionManager->selectNonAdmittedQuestions();
        $questions = $adminManager->createArrayNonAdmittedQuestions($questions);

        return $this->twig->render('Admin/panel.html.twig', [
            'questions' => $questions,
        ]);
    }

    public function handlingQuestions()
    {
        /* This handles the form that can accept or delete a question.
        It can also modify the questions which is why we update the answers as well as the question.
        After this is done we return to the admin panel.*/
        $adminManager = new AdminManager();
        $adminManager->isAdminConnected();
        $questionManager = new QuestionManager();
        $answersManager = new AnswersManager();
        $managementManager = new ManagementManager();

        if (isset($_POST["delete"])) {
            $questionManager->delete($_POST['id']);
            $answersManager->deleteAnswers($_POST['id']);
        } elseif (isset($_POST["accept"])) {
            $questionManager->updateQuestion($_POST['id'], $_POST['title']);
            $answerArray = $managementManager->getAnswersFromForm($_POST["firstAnswerId"]);
            $answersManager->updateAnswers($answerArray, $_POST["firstAnswerId"]);
            $adminManager->sendImageForAQuestion();
        }
        return $this->showPanel();
    }
}
