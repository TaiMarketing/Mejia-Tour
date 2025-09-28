<?php
// reviews.php: Save and load reviews for Saona Island Tour
$reviews_file = 'reviews.txt';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $date = htmlspecialchars($_POST['date']);
    $rating = intval($_POST['rating']);
    $review = htmlspecialchars($_POST['review']);
    $entry = json_encode([
        'name' => $name,
        'date' => $date,
        'rating' => $rating,
        'review' => $review
    ]);
    file_put_contents($reviews_file, $entry . "\n", FILE_APPEND);
    echo 'ok';
    exit;
}
// Load reviews
$reviews = [];
if (file_exists($reviews_file)) {
    $lines = file($reviews_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $reviews[] = json_decode($line, true);
    }
}
header('Content-Type: application/json');
echo json_encode($reviews);
