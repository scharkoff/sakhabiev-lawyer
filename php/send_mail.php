<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Подключение автозагрузчика Composer
require __DIR__ . '/vendor/autoload.php';

// Старт сессии
session_start();

$mail = new PHPMailer(true);

try {
    // Получение данных из формы
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comment = $_POST['comment'];

    // Настройки SMTP
    $mail->isSMTP();
    $mail->SMTPDebug = 0; // Уровень отладки
    $mail->Host = 'smtp.mail.ru';
    $mail->SMTPAuth = true;
    $mail->Username = 'bulat.sakhabiyev@bk.ru';
    $mail->Password = 'f0gjgWC50ivJyzns31QY';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SMTPS для порта 465
    $mail->Port = 465; // Порт SSL

    // Настройка отправителя и получателя
    $mail->setFrom('bulat.sakhabiyev@bk.ru', $name);
    $mail->addAddress('bulat.sakhabiyev@bk.ru'); // Отправка письма самому себе

    // Настройки содержимого письма
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8'; // Установка кодировки
    $mail->Encoding = 'base64'; // Установка метода кодирования
    $mail->Subject = 'Новая заявка с Вашего сайта sakhabiev.ru';
    $mail->Body = "
    <html>
    <head>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007BFF;
        }
        p {
            margin: 10px 0;
        }
    </style>
    </head>
    <body>
    <div class='container'>
        <h2>Пользователь оставил заявку на консультацию на Вашем сайте</h2>
        <p><strong>От:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Телефон:</strong> $phone</p>
        <p><strong>Комментарий:</strong> $comment</p>
    </div>
    </body>
    </html>
    ";

    // Отправка письма
    $mail->send();
    $_SESSION['status'] = ['type' => 'success', 'message' => 'Заявка успешно отправлена'];
} catch (Exception $e) {
    $_SESSION['status'] = ['type' => 'danger', 'message' => "Произошла серверная неполадка. Ошибка: {$mail->ErrorInfo}"];
}

// Редирект обратно на страницу формы
header('Location: /index.php'); // Замените /index.php на путь к вашей странице
exit();
