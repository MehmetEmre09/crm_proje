<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = trim($_POST['usernameOrEmail'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$usernameOrEmail || !$password) {
        $error = "Lütfen tüm alanları doldurun.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$usernameOrEmail, $usernameOrEmail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Kullanıcı adı/email veya şifre yanlış.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Giriş Yap</title></head>
<body>
<h2>Giriş Yap</h2>

<?php if (!empty($error)) : ?>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
    Kullanıcı Adı veya E-posta: <input type="text" name="usernameOrEmail" required><br>
    Şifre: <input type="password" name="password" required><br>
    <button type="submit">Giriş Yap</button>
</form>

<a href="register.php">Hesabın yok mu? Kayıt ol</a>
</body>
</html>
