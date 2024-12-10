<?php
// -------------------------------
// FORMULARZ KONTAKTOWY
// -------------------------------

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
        PokazKontakt(); // Powrót do formularza
    } else {
        // Dane wiadomości
        $mail['subject'] = htmlspecialchars($_POST['temat'], ENT_QUOTES, 'UTF-8');
        $mail['body'] = htmlspecialchars($_POST['tresc'], ENT_QUOTES, 'UTF-8');
        $mail['sender'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $mail['recipient'] = $odbiorca; // Adres odbiorcy

        // Nagłówki wiadomości
        $header = "From: Formularz kontaktowy <" . $mail['sender'] . ">\n";
        $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding: 8bit\n";
        $header .= "X-Sender: <" . $mail['sender'] . ">\n";
        $header .= "X-Mailer: PHP/" . phpversion() . "\n";
        $header .= "X-Priority: 3\n";
        $header .= "Return-Path: <" . $mail['sender'] . ">\n";

        // Wysyłanie maila
        mail($mail['recipient'], $mail['subject'], $mail['body'], $header);

        echo "Wiadomość wysłana!";
    }
}

// Funkcja przypominająca hasło
function PrzypomnijHaslo($odbiorca, $haslo)
{
    // Dane wiadomości
    $mail['subject'] = "Przypomnienie hasła";
    $mail['body'] = "Twoje hasło do panelu administracyjnego to: " . htmlspecialchars($haslo, ENT_QUOTES, 'UTF-8');
    $mail['recipient'] = $odbiorca;

    // Nagłówki wiadomości
    $header = "From: Formularz kontaktowy <no-reply@twojastrona.com>\n";
    $header .= "MIME-Version: 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding: 8bit\n";
    $header .= "X-Mailer: PHP/" . phpversion() . "\n";
    $header .= "X-Priority: 3\n";

    // Wysyłanie maila
    mail($mail['recipient'], $mail['subject'], $mail['body'], $header);

    echo "Hasło zostało wysłane!";
}

// -------------------------------
// OBSŁUGA AKCJI FORMULARZA
// -------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obsługa wysyłania wiadomości
    if ($_POST['action'] == 'send_mail') {
        WyslijMailKontakt("example@gmail.com"); // Podaj swój e-mail odbiorcy
    }
    // Obsługa przypominania hasła
    elseif ($_POST['action'] == 'remind_password') {
        PrzypomnijHaslo("example@gmail.com", "twojehaslo123"); // Przykładowe hasło
    }
}
?>
