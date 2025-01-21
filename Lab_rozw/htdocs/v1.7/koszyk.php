<?php
require('cfg.php');
// Upewnij się, że koszyk istnieje w sesji
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    global $link;
    $query = "SELECT id, tytul, cena_netto, podatek_vat FROM produkty WHERE id = $productId LIMIT 1";
    $result = mysqli_query($link, $query);

    if ($product = $result->fetch_assoc()) {
        if (!empty($product['zdjecie'])) {
            echo '<p>Zdjęcie znalezione w bazie!</p>';
        } else {
            echo '<p>sdds!</p>';
        }
        // Dodaj produkt do koszyka lub zaktualizuj ilość
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = [
                'title' => $product['tytul'],
                'price_netto' => $product['cena_netto'],
                'vat' => $product['podatek_vat'],
                'quantity' => $quantity,
            ];
        }
    }

}

// Wyświetl zawartość koszyka
function showCart() {

    if (empty($_SESSION['cart'])) {
        return "</div>";
    }

    $html = '<table cellpadding="7">';
    $html .= '<tr><th>Zdj</th><th>Produkt</th><th>Ilość</th><th>Cena netto</th><th>VAT</th><th>Cena brutto</th><th>Opcje</th></tr>';
    $total = 0;

    foreach ($_SESSION['cart'] as $productId => $product) {
        $price_brutto = $product['price_netto'] * (1 + $product['vat'] / 100);
        $subtotal = $price_brutto * $product['quantity'];
        $total += $subtotal;
        global $link;
        $query = "SELECT zdjecie FROM produkty WHERE id = $productId LIMIT 1";
        $result = mysqli_query($link, $query);
        $imageData = $result->fetch_assoc();
        
        $html .= '<tr>';
            // Wyświetlanie zdjęcia
            if (!empty($imageData['zdjecie'])) {
                $html .= '<td><img src="data:image/jpeg;base64,' . base64_encode($imageData['zdjecie']) . '" alt="Zdjęcie" style="width:60px;height:auto;"></td>';
            } else {
                $html .= '<td>Brak zdjęcia</td>';
            }
        $html .= '<td>' . htmlspecialchars($product['title']) . '</td>';
        $html .= '<td>' . htmlspecialchars($product['quantity']) . '</td>';
        $html .= '<td>' . number_format($product['price_netto'], 2, ',', '') . ' zł</td>';
        $html .= '<td>' . htmlspecialchars($product['vat']) . '%</td>';
        $html .= '<td>' . number_format($subtotal, 2, ',', '') . ' zł</td>';
        $html .= '<td>
                    <form method="post">
                        <input type="hidden" name="remove_id" value="' . $productId . '">
                        <button type="submit" name="remove_from_cart">Usuń</button>
                    </form>
                  </td>';
        $html .= '</tr>';
    }

    $html .= '<tr><td colspan="4"><strong>Łączna wartość:</strong></td><td colspan="2"><strong>' . number_format($total, 2, ',', '') . ' zł</strong></td></tr>';
    $html .= '</table>';
    $html .= '</div>';
    $html .= '<center><button type="submit" style="padding: 10px 20px;width: 30%;">Zamów</button>';
    return $html;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $productId = intval($_POST['remove_id']);
    unset($_SESSION['cart'][$productId]);
}
