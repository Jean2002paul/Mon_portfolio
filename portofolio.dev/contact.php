<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    if (!empty($name) && !empty($email) && !empty($message)) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'zialengorlouis@gmail.com';  // Remplace par ton email
            $mail->Password = 'tonmotdepasse';  // Ton mot de passe ou App Password Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($email, $name);
            $mail->addAddress('zialengorlouis@gmail.com'); // Ton email de réception
            $mail->Subject = "📩 Nouveau message de $name";
            $mail->Body = "Nom: $name\nEmail: $email\n\nMessage:\n$message";

            $mail->send();
            $successMessage = "<div class='alert alert-success text-center mt-3'>✅ Message envoyé avec succès !</div>";
        } catch (Exception $e) {
            $errorMessage = "<div class='alert alert-danger text-center mt-3'>❌ Erreur d'envoi : {$mail->ErrorInfo}</div>";
        }
    } else {
        $errorMessage = "<div class='alert alert-warning text-center mt-3'>⚠️ Tous les champs doivent être remplis.</div>";
    }
}
?>

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

<?php include("includes/footer.php"); ?>
