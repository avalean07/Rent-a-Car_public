<?php
header('Content-Type: application/json');

$tags = [
    "C++", "Java", "PHP", "JavaScript", "Python", "Ruby", "Perl",
    "Swift", "Kotlin", "HTML", "CSS", "TypeScript", "R", "Go",
    "Scala", "SQL", "Bash", "Matlab", "Dart", "Lua", "Rust"
];

echo json_encode($tags);
//the tags file, seems to work fine having them in separate folders like specified on the website 
//provided in the pdf
?>
