<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Kết nối CSDL thất bại: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS quiz";
if ($conn->query($sql) === TRUE) {
    echo "CSDL 'quiz' đã được tạo thành công.\n";
} else {
    echo "Lỗi khi tạo CSDL: " . $conn->error;
}

$conn->select_db("quiz");

$sql = "CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    option_a TEXT NOT NULL,
    option_b TEXT NOT NULL,
    option_c TEXT NOT NULL,
    option_d TEXT NOT NULL,
    correct_answer CHAR(1) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tạo thành công bảng 'questions'.\n";
} else {
    echo "Lỗi khi tạo bảng: " . $conn->error;
}

$conn->close();
?>
<?php
$filename = "question.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$answers = [];
$current_question = [];
foreach ($questions as $line) {
    if (strpos($line, "Câu") === 0) {
        if (!empty($current_question)) {
            // Lưu câu trả lời đúng vào mảng
            if (isset($current_question[5])) {
                $answers[] = trim(substr($current_question[5], strpos($current_question[5], ":") + 1));
            }
        }
        $current_question = [];
    }
    $current_question[] = $line;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài trắc nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Bài Trắc Nghiệm</h2>
        <form method="post" action="result.php">
            <?php
            // Hiển thị câu hỏi và đáp án
            $current_question = [];
            foreach ($questions as $index => $question) {
                if (strpos($question, "Câu") === 0) {
                    $current_question = [];
                    $current_question[] = $question;
                    $current_question[] = $questions[$index + 1];
                    $current_question[] = $questions[$index + 2];
                    $current_question[] = $questions[$index + 3];
                    $current_question[] = $questions[$index + 4];
                    $current_question[] = $questions[$index + 5];

                    echo "<div class='card mb-4'>";
                    echo "<div class='card-header'><strong>{$current_question[0]}</strong></div>";
                    echo "<div class='card-body'>";
                    
                    for ($i = 1; $i <= 4; $i++) {
                        $answer = substr($current_question[$i], 0, 1); // A, B, C, D
                        echo "<div class='form-check'>";
                        echo "<input class='form-check-input' type='radio' name='question{$index}' value='{$answer}' id='question{$index}{$answer}'>";
                        echo "<label class='form-check-label' for='question{$index}{$answer}'>{$current_question[$i]}</label>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";
                }
            }
            ?>
            <button type="submit" class="btn btn-primary">Nộp bài</button>
        </form>
    </div>
</body>
</html>