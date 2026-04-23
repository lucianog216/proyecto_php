<?php
$pokemon = isset($_GET['pokemon']) ? strtolower($_GET['pokemon']) : null;
$data = null;
$error = null;

if ($pokemon) {
    $url = "https://pokeapi.co/api/v2/pokemon/" . $pokemon;

    $response = @file_get_contents($url);

    if ($response === FALSE) {
        $error = "Pokémon no encontrado o error en la API";
    } else {
        $data = json_decode($response, true);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pokédex PHP</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <h1>🔎 Buscar Pokémon</h1>

    <form method="GET">
        <input type="text" name="pokemon" placeholder="Ej: pikachu" required>
        <button type="submit">Buscar</button>
    </form>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($data): ?>
        <div class="card">
            <h2><?php echo ucfirst($data['name']); ?></h2>

            <img src="<?php echo $data['sprites']['front_default']; ?>" alt="pokemon">

            <p><strong>Altura:</strong> <?php echo $data['height']; ?></p>
            <p><strong>Peso:</strong> <?php echo $data['weight']; ?></p>

            <p><strong>Habilidades:</strong></p>
            <ul>
                <?php foreach ($data['abilities'] as $ability): ?>
                    <li><?php echo $ability['ability']['name']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

</body>

</html>
