<?php
// Funkcja pokazująca formularz kontaktowy
function PokazKontakt()
{
    echo '<div class="main_form">
            <h1>Skontaktuj się z nami</h1>
            <div class="formularz">
                <form method="post" action="">
                    <input type="email" name="email" placeholder="Adres E-mail" required><br>
                    <input type="text" name="temat" placeholder="Temat" required><br>
                    <textarea name="tresc" rows="5" placeholder="Wiadomość" required></textarea><br>
                    <input type="hidden" name="action" value="send_mail">
                    <input type="submit" value="Wyślij">
                </form>
            </div>
          </div>';
}

// Funkcja wysyłająca wiadomość mailową
function WyslijMailKontakt($odbiorca)
{
    if (empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email'])) {
        echo '[nie_wypelniles_pola]';
        PokazKontakt(); // Powrot do formularza
    } else {
        $mail['subject'] = $_POST['temat'];
        $mail['body'] = $_POST['tresc'];
        $mail['sender'] = $_POST['email'];
        $mail['recipient'] = $odbiorca; // Adres odbiorcy

        $header = "From: Formularz kontaktowy <" . $mail['sender'] . ">\n";
        $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding: 8bit\n";
        $header .= "X-Sender: <" . $mail['sender'] . ">\n";
        $header .= "X-Mailer: PHP/" . phpversion() . "\n";
        $header .= "X-Priority: 3\n";
        $header .= "Return-Path: <" . $mail['sender'] . ">\n";

        mail($mail['recipient'], $mail['subject'], $mail['body'], $header);

        echo "Wiadomość wysłana!";
    }
}

// Funkcja przypominająca hasło
function PrzypomnijHaslo($odbiorca, $haslo)
{
    $mail['subject'] = "Przypomnienie hasła";
    $mail['body'] = "Twoje hasło do panelu administracyjnego to: " . $haslo;
    $mail['recipient'] = $odbiorca;

    $header = "From: Formularz kontaktowy <no-reply@twojastrona.com>\n";
    $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding: 8bit\n";
    $header .= "X-Mailer: PHP/" . phpversion() . "\n";
    $header .= "X-Priority: 3\n";

    mail($mail['recipient'], $mail['subject'], $mail['body'], $header);

    echo "Hasło zostało wysłane!";
}

// Obsługa akcji z formularza
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'send_mail') {
        WyslijMailKontakt("example@gmail.com"); // Podaj swój e-mail odbiorcy
    } elseif ($_POST['action'] == 'remind_password') {
        PrzypomnijHaslo("example@gmail.com", "twojehaslo123"); // Przykładowe hasło
    }
}
?>