<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['QuestionController', 'show',],
    'add-question' => ['ManagementController', 'showFormAddQuestion',],
    'result' => ['QuestionController', 'showResults'],
    'login' => ['AdminController', 'showLogin'],
    'panel' => ['AdminController', 'showPanel'],
    'edit' => ['AdminController', 'handlingQuestions'],
    'success' => ['SuccessController', 'success'],
    'legalnotices' => ['LegalNoticesController', 'legalNotices'],
];
