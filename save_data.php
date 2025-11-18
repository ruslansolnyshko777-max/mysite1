<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $country = $_POST['country'] ?? '';
    $message = $_POST['message'] ?? '';
    
    // Создаем строку с данными
    $data = "=== Новая запись ===\n";
    $data .= "Время: " . date('Y-m-d H:i:s') . "\n";
    $data .= "Имя: " . $name . "\n";
    $data .= "Почта: " . $email . "\n";
    $data .= "Телефон: " . $phone . "\n";
    $data .= "Пол: " . $gender . "\n";
    $data .= "Страна: " . $country . "\n";
    $data .= "Сообщение: " . $message . "\n";
    $data .= "===================\n\n";
    
    // Сохраняем в файл
    $filename = "form_data.txt";
    file_put_contents($filename, $data, FILE_APPEND | LOCK_EX);
    
    // Перенаправляем обратно на страницу
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=1");
    exit();
} else {
    header("Location: index.html");
    exit();
}
?>
