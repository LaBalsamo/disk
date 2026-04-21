<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'restauracja'); // [cite: 284, 289]

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];
    
    // Pobieramy ID konta oraz ewentualne ID pracownika przypisane do tego konta
    $query = "SELECT id, pracownik_id FROM konta WHERE login='$login' AND haslo='$haslo'";
    $result = mysqli_query($conn, $query); // [cite: 289]
    
    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['user_id'] = $row['id'];
        
        // Sprawdzamy czy pracownik_id nie jest pusty
        if (!empty($row['pracownik_id'])) {
            // Pobieramy stanowisko, aby wiedzieć co pracownik może robić [cite: 203, 225]
            $p_id = $row['pracownik_id'];
            $st_query = "SELECT stanowisko FROM pracownicy WHERE id = $p_id";
            $st_result = mysqli_query($conn, $st_query);
            $st_row = mysqli_fetch_assoc($st_result);
            
            $_SESSION['role'] = 'pracownik';
            $_SESSION['stanowisko'] = $st_row['stanowisko']; // 1-kucharz, 2-pomoc, 3-kelner, 4-barman [cite: 203]
        } else {
            $_SESSION['role'] = 'klient';
        }
        
        header("Location: restauracja.php");
    } else {
        echo "Błędny login lub hasło";
    }
}
?>