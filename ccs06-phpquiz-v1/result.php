<?php

require "vendor/autoload.php";

session_start();

// 4.

use App\QuestionManager;

$score = null;
try {
    $manager = new QuestionManager;
    $manager->initialize();

    if (!isset($_SESSION['answers'])) {
        throw new Exception('Missing answers');
    }
    $score = $manager->computeScore($_SESSION['answers']);
} catch (Exception $e) {
    echo '<h1>An error occurred:</h1>';
    echo '<p>' . $e->getMessage() . '</p>';
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz</title>
</head>
<body>

<h1>Thank You!</h1>

<p style="color: gray">
    You've completed the exam.
</p>

<p>
    Congratulations <?php echo $_SESSION['user_fullname'] . '(' . $_SESSION['email'] . ')'; ?> <br>
    Your score is <?php echo "<span style='color:blue; font-weight:bold;'>  $score </span>"; ?> out of <?php echo '<b>' . $manager->getQuestionSize() . '</b>' ;?></p>
    <p>Your Answers</p>
    <ol>
    
    <?php  foreach ($_SESSION['answers'] as $number => $allAnswers) {
         echo "<li>$allAnswers ";
          if ($allAnswers == $manager->returnCorrect()[$number]) {
            echo '<span style="color:blue;">(correct)</span></li>';
         } else {
            echo '<span style="color:red;">(incorrect)</span></li>';
         }
         
        }?>
        </ol>
    
</body>
</html>

<!-- DEBUG MODE -->
 <pre>
 <?php
//var_dump($_SESSION);
?>
</pre>