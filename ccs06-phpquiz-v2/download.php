<?php

require "vendor/autoload.php";
session_start();
use App\QuestionManager;
$manager = new QuestionManager;
$everyAnswer = null;
$score = $manager->computeScore($_SESSION['answers']);

$fileContent = 'Complete Name: ' . $_SESSION['user_fullname'] . "\n" .
"Email: " . $_SESSION['email'] . "\n" .
'Birthdate: ' . $_SESSION['birthdate'] . "\n" .
'Gender: ' . $_SESSION['gender'] . "\n" . 'Score: ' . $score . 
"\n" ."Answers:\n" ;

?>


    
<?php  foreach ($_SESSION['answers'] as $number => $allAnswers) {
     $everyAnswer .= "$number. $allAnswers ";
      if ($allAnswers == $manager->returnCorrect()[$number]) {
        $everyAnswer .= '(correct)' . "\n";
     } else {
        $everyAnswer .= "(incorrect)\n" ;
     }
     
    }
    $fileContent .= $everyAnswer;
file_put_contents("results.txt", $fileContent);
    ?>
    
<h1>RESULTS</h1>
    <ol>
    
    <?php 
    echo 'Complete Name: ' . $_SESSION['user_fullname'] . "<br>" .
    "Email: " . $_SESSION['email'] . "<br>" .
    'Birthdate: ' . $_SESSION['birthdate'] . "<br>" .
    'Gender: ' . $_SESSION['gender'] . "<br>" . 'Score: ' . $score . '<br>' . "Answers:<br>" ;
    foreach ($_SESSION['answers'] as $number => $allAnswers) {
         echo "<li>$allAnswers ";
          if ($allAnswers == $manager->returnCorrect()[$number]) {
            echo '(correct)</li>';
         } else {
            echo '(incorrect)</li>';
         }
         
        }?>
        </ol>