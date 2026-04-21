
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Restauracja Wszystkie Smaki</title>
    <link rel="stylesheet" href="styl_1.css">
</head>
<body>
    <header>
        <h1>Witamy w restauracji „Wszystkie Smaki”</h1> [cite: 104]
    </header>
    
    <main>
        <div id="lewy"><img src="menu.jpg" alt="Nasze danie"></div> [cite: 104]
        
        <div id="dolny">
            <?php if (!isset($_SESSION['user_id'])): ?>
                <h2>Logowanie dla pracowników</h2>
                <form action="login.php" method="post">
                    Login: <input type="text" name="login"><br>
                    Hasło: <input type="password" name="haslo"><br>
                    <button type="submit">ZALOGUJ</button>
                </form>

            <?php elseif ($_SESSION['role'] == 'pracownik'): ?>
                <h2>Panel Pracownika - Nowe Zamówienie</h2>
                <form action="zamowienie_wewnatrz.php" method="post">
                    Numer stolika: <input type="number" name="stolik"><br>
                    Danie: 
                    <select name="danie">
                        <?php
                        $conn = mysqli_connect('localhost', 'root', '', 'restauracja');
                        $res = mysqli_query($conn, "SELECT id, nazwa FROM dania");
                        while($row = mysqli_fetch_assoc($res)) {
                            echo "<option value='{$row['id']}'>{$row['nazwa']}</option>";
                        }
                        ?>
                    </select><br>
                    <button type="submit">DODAJ ZAMÓWIENIE</button>
                </form>
                <a href="logout.php">Wyloguj</a>

            <?php else: ?>
                <h2>Zarezerwuj stolik on-line</h2> [cite: 107]
                <form action="rezerwacja.php" method="post">
                    Data: <input type="text" name="data"><br> [cite: 109]
                    Ile osób?: <input type="number" name="osoby"><br> [cite: 110]
                    Telefon: <input type="text" name="tel"><br> [cite: 111]
                    <button type="submit">REZERWUJ</button> [cite: 114]
                </form>
                <a href="logout.php">Wyloguj</a>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p><i>Stronę internetową opracował: [PESEL]</i></p> [cite: 115]
    </footer>
</body>
</html>