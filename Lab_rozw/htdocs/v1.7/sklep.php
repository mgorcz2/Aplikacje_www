<?php
require('cfg.php');
global $link;

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Inicjalizacja koszyka, jeśli nie istnieje
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $productId = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    // Sprawdź, czy produkt już jest w koszyku
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        // Pobierz dane produktu z bazy
        $query = "SELECT id, tytul, cena_netto, podatek_vat FROM produkty WHERE id = $productId";
        $result = mysqli_query($link, $query);

        if ($product = $result->fetch_assoc()) {
            $_SESSION['cart'][$productId] = [
                'title' => $product['tytul'],
                'price_netto' => $product['cena_netto'],
                'vat' => $product['podatek_vat'],
                'quantity' => $quantity,
            ];
        }
    }
    // Przekierowanie na tę samą stronę
    header('Location:index.php?idp=sklep'); 
    exit;
}   


function DodajProduktyDoSklepu() {
    global $link; 

    // pobiera produkty oraz nazwy kategorii
    $query = "
        SELECT p.*, k.nazwa AS kategoria_nazwa 
        FROM produkty p
        LEFT JOIN kategorie k ON p.kategoria_id = k.id
        ORDER BY k.nazwa, p.tytul
    ";
    $result = mysqli_query($link, $query);
    if (!$result) {
        return "<p>Błąd podczas pobierania produktów: " . mysqli_error($link) . "</p>";
    }
    $kategorie = []; // Grupowanie produktów po nazwach kategorii
    while ($row = mysqli_fetch_assoc($result)) {
        $kategorie[$row['kategoria_nazwa']][] = $row;
    }
    
    $html='';
    // generuje sekcj dla każdej kategorii
    foreach ($kategorie as $kategoria => $produkty) {
        $html .= '<h2>' . htmlspecialchars($kategoria) . '</h2>';
        foreach ($produkty as $produkt) {
            $cena_brutto = $produkt['cena_netto'] * (1 + $produkt['podatek_vat'] / 100);
            $html .= '<div class="produkt">';
            $html .= '<img src="' . htmlspecialchars($produkt['zdjecie']) . '" alt="' . htmlspecialchars($produkt['tytul']) . '">';
            $html .= '<img src="img/' . htmlspecialchars($produkt['zdjecie']) . '" alt="Zdjęcie" style="width:200px;height:auto;"></td>';
            $html .= '<p class="nazwa"><b>' . htmlspecialchars($produkt['tytul']) . '</b></p>';
            $html .= '<p class="p">Status: ' . ($produkt['status'] == 1 ? 'Dostępny' : 'Niedostępny') . '</p>';
            $html .= '<p class="p">Ilość: ' . htmlspecialchars($produkt['ilosc']) . '</p>';
            $html .= '<p class="p">Cena netto: ' . htmlspecialchars($produkt['cena_netto']) . ' zł</p>';
            $html .= '<p class="p">VAT: ' . htmlspecialchars($produkt['podatek_vat']) . ' %</p>';
            $html .= '<p class="cena">Cena brutto: '  . number_format($cena_brutto, 2, ',',)  . ' zł</p>';
            // Formularz dodawania do koszyka   
            $html .= '<form class="add-to-cart-form" method="post">';
            $html .= '<input type="hidden" name="product_id" value="' . htmlspecialchars(string: $produkt['id']) . '">';
            $html .= '<label for="quantity_' . htmlspecialchars($produkt['id']) . '">Ilość:</label>';
            $html .= '<input type="number" class="quantity" id="quantity_' . htmlspecialchars($produkt['id']) . '" name="quantity" value="1" min="1" max="' . htmlspecialchars($produkt['ilosc']) . '" required>';
            $html .= '<button type="submit" name="add_to_cart">Dodaj do koszyka</button>';
            $html .= '</form>';
            $html .= '</div>';
        }
    }

    $html .= '</div>';
    return $html;
}

?>

