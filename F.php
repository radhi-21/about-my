<?php
$errors = [];
$saved = false;

$isPost = ($_SERVER["REQUEST_METHOD"] ?? "GET") === "POST";

function getField($key) {
    $value = $_POST[$key] ?? "";

    return is_string($value) ? trim($value) : "";
}

if ($isPost) {
    $name = getField("name");
    $email = getField("email");
    $message = getField("message");

    if ($name === "") {
        $errors[] = "Name is required.";
    } elseif (mb_strlen($name, "UTF-8") > 100) {
        $errors[] = "Name must not exceed 100 characters.";
    }

    if ($email === "") {
        $errors[] = "Email is required.";
    } elseif (
        strlen($email) > 254 ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        $errors[] = "Please enter a valid email address.";
    }

    if ($message === "") {
        $errors[] = "Message is required.";
    } elseif (mb_strlen($message, "UTF-8") > 5000) {
        $errors[] = "Message must not exceed 5000 characters.";
    }

    if (empty($errors)) {
        try {
            require __DIR__ . "/db.php";

            $stmt = $connection->prepare(
                "INSERT INTO messages (name, email, message)
                 VALUES (?, ?, ?)"
            );

            $stmt->bind_param("sss", $name, $email, $message);
            $stmt->execute();

            $saved = true;

            $stmt->close();
            $connection->close();
        } catch (mysqli_sql_exception $error) {
            error_log($error->getMessage());

            $errors[] =
                "Could not save your message. Please check the database connection and table setup.";
        }
    }
}

if ($saved) {
    $title = "Message Saved";
} elseif ($isPost) {
    $title = "Please Check Your Details";
} else {
    $title = "Contact Form";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Contact Form Result</title>

    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>
    <main class="container">
        <section class="result-card">
            <h1>
                <?= htmlspecialchars($title, ENT_QUOTES, "UTF-8") ?>
            </h1>

            <?php if ($saved): ?>

                <p>Your message has been saved successfully.</p>

            <?php elseif (!empty($errors)): ?>

                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li>
                            <?= htmlspecialchars( $error, ENT_QUOTES,"UTF-8") ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

            <?php else: ?>

                <p>Please open the contact form to enter your details.</p>

            <?php endif; ?>

            <a href="about.php#contact" class="btn btn-primary">
                Back to Contact
            </a>
        </section>
    </main>
</body>
</html>