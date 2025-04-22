<?php
require 'config.php'; // Fichier de connexion à la base de données


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center mt-3' id='fadeMessage'>✅ Message reçu avec succès ! Nous vous répondrons dans les plus brefs délais.</div>";
        } else {
            echo "<div class='alert alert-danger text-center mt-3'>❌ Erreur lors de l'enregistrement.</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-warning text-center mt-3'>⚠️ Tous les champs doivent être remplis.</div>";
    }
}
?>

<script>
    // Fonction pour faire disparaître le message après 8 secondes
    setTimeout(() => {
        const message = document.getElementById('fadeMessage');
        if (message) {
            message.style.transition = "opacity 1s";
            message.style.opacity = "0";
            setTimeout(() => message.remove(), 1000);
        }
    }, 8000);
</script>



<?php include("includes/header.php"); ?>

<section class="contact">
    <div class="container">
        <h2 class="text-center fw-bold">📩 Contactez-moi</h2>
        <p class="lead text-center">Besoin d’un projet web ou mobile ? Envoyez-moi un message !</p>

        <?php if (isset($successMessage)) echo $successMessage; ?>
        <?php if (isset($errorMessage)) echo $errorMessage; ?>

        <form action="contact.php" method="POST" class="contact-form">
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-info btn-lg">Envoyer</button>
        </form>
    </div>
</section>

<section class="social-media mt-5">
    <div class="container">
        <h2 class="text-center fw-bold">🌍 Suivez-moi sur les réseaux</h2>
        <p class="lead text-center">Restons connectés sur mes plateformes sociales !</p>

        <div class="row justify-content-center">
            <div class="col-md-2 text-center">
                <a href="https://wa.me/96438002" target="_blank" class="social-icon whatsapp">
                    <i class="fab fa-whatsapp fa-3x"></i>
                </a>
            </div>
            <div class="col-md-2 text-center">
                <a href="https://facebook.com/jeanpaul.zialengor/" target="_blank" class="social-icon facebook">
                    <i class="fab fa-facebook fa-3x"></i>
                </a>
            </div>
            <div class="col-md-2 text-center">
                <a href="https://www.linkedin.com/in/tonpseudo" target="_blank" class="social-icon linkedin">
                    <i class="fab fa-linkedin fa-3x"></i>
                </a>
            </div>
            <div class="col-md-2 text-center">
                <a href="https://instagram.com/tonpseudo" target="_blank" class="social-icon instagram">
                    <i class="fab fa-instagram fa-3x"></i>
                </a>
            </div>
        </div>
    </div>
</section>


<?php include("includes/footer.php"); ?>
