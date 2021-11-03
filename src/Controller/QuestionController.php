<?php

namespace App\Controller;

use App\Model\QuestionManager;
use App\Model\AnswersManager;
use App\Model\ItemManager;

class QuestionController extends AbstractController
{
    /**
     * List questions
     */
    public function index(): string
    {
        $questionManager = new QuestionManager();
        $question = $questionManager->getRandomQuestion();
        $idQuestion = $question['id']; // identifiant de la question
        $answersManager = new AnswersManager();
        $answers = $answersManager->getAnswersForQuestion($idQuestion);
        shuffle($answers);
        $answersOrder = "";
        $numberOfAnswers = count($answers);
        for ($i = 0; $i < $numberOfAnswers; $i++) {
            $answersOrder .=  $answers[$i]['id'] . ";";
        }
        return $this->twig->render('Home/index.html.twig', [
            'question' => $question,
            'answers' => $answers,
            'answersOrder' => $answersOrder
        ]);
    }

    /* Function to get the answers with the right order*/
    public function answers()
    {
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            $idLastQuestion = $_POST['questionId'];
            $questionManager = new QuestionManager();
            $lastQuestion = $questionManager->selectOneById($idLastQuestion);
            $answersManager = new AnswersManager();
            /* Il faut remettre les réponses dans l'ordre dans
            lequel elles étaient affichées dans la page de question */

            // On récupère l'ordre dans lesquelles étaient affichées les réponses dans la pages de question
            $order = explode(";", $_POST['answersOrder']);
             // récupération des réponses renvoyées dans l'ordre de la base SQL
            $answersTemp = $answersManager->getAnswersForQuestion($idLastQuestion);
            // Ce sera le tableau final avec les réponses dans le bon ordre, envoyé à la vue
            $answers = [];
            $orderSize = count($order);
            // On parcourt l'ordre des IDs dans lequel les réponses étaient affichées dans la page de questions
            for ($i = 0; $i < $orderSize; $i++) {
                // on parcourt les réponses dans l'ordre dans lequel le SQL nous a retourné les réponses
                $answersTempSize = count($answersTemp);
                for ($j = 0; $j < $answersTempSize; $j++) {
                    // si l'id correspond à celui de la réponse, on a trouvé le prochain item a afficher
                    if ($answersTemp[$j]['id'] === $order[$i]) {
                        $answers[$i] = $answersTemp[$j]; // On l'ajoute au tableau final
                    }
                }
            }
            return $this->twig->render('Home/answers.html.twig', ['question' => $lastQuestion, 'answers' => $answers]);
        }
    }

    /**
     * Show informations for a specific question
     */
    public function show(int $id): string
    {
        $itemManager = new ItemManager();
        $item = $itemManager->selectOneById($id);

        return $this->twig->render('Item/show.html.twig', ['item' => $item]);
    }


    /**
     * Edit a specific item
     */
    public function edit(int $id): string
    {
        $itemManager = new ItemManager();
        $item = $itemManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $item = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $itemManager->update($item);
            header('Location: /items/show?id=' . $id);
        }

        return $this->twig->render('Item/edit.html.twig', [
            'item' => $item,
        ]);
    }


    /**
     * Add a new item
     */
    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $item = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $itemManager = new ItemManager();
            $id = $itemManager->insert($item);
            header('Location:/items/show?id=' . $id);
        }

        return $this->twig->render('Item/add.html.twig');
    }


    /**
     * Delete a specific item
     */
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $itemManager = new ItemManager();
            $itemManager->delete((int)$id);
            header('Location:/items');
        }
    }
}
