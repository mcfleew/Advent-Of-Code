<?php echo '<pre>';

$groups = explode(str_repeat(PHP_EOL, 2), file_get_contents('../../input'));
$askedQuestions = range('a', 'z');

$yesRepliesInGroups = [];
foreach($groups as $group) {
    $questions = str_split($group);
    $anwserYes = 0;

    $questions = array_unique($questions);

    foreach($questions as $question) {
        if (in_array($question, $askedQuestions)){
            $anwserYes++;
        }
    }
    $yesRepliesInGroups[] = $anwserYes;
}

echo array_sum($yesRepliesInGroups);