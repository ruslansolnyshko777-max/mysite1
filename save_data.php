<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $gender = htmlspecialchars($_POST['gender'] ?? '');
    $country = htmlspecialchars($_POST['country'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');
    
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
    
    // Имя файла
    $filename = "form_data.txt";
    
    // Пытаемся сохранить в файл
    $result = file_put_contents($filename, $data, FILE_APPEND | LOCK_EX);
    
    if ($result === false) {
        // Если не удалось записать, пробуем создать файл
        file_put_contents($filename, "");
        // Пробуем снова
        $result = file_put_contents($filename, $data, FILE_APPEND | LOCK_EX);
    }
    
    // Перенаправляем обратно на страницу
    if ($result !== false) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?success=1");
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?error=1");
    }
    exit();
} else {
    header("Location: index.html");
    exit();
}
?>
