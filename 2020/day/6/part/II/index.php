<?php echo '<pre>';

$groups = explode(str_repeat(PHP_EOL, 2), file_get_contents('../../input'));

$yesRepliesInGroups = [];
foreach($groups as $group) {
    $questionsGroups = explode(PHP_EOL, $group);
    $questionsGroups = array_map('str_split', $questionsGroups);

    $intersection = array_shift($questionsGroups);

    foreach($questionsGroups as $questionsGroup) {
        $intersection = array_intersect($intersection, $questionsGroup);
    }
    
    $yesRepliesInGroups[] = count($intersection);
}

echo array_sum($yesRepliesInGroups);