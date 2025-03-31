<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP 2024</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <link rel="stylesheet" type="text/css" href="style/normalize.css">
</head>

<body>
<header>
    <h1>Login & Forms</h1>
    <a href="http://localhost/PHP-2024/">Home</a> |
    <a href="http://localhost/PHP-2024/tester.php">Test Environment</a> |
    <a href="http://localhost/PHP-2024/convert.php">Temp converter</a> |
    <a href="http://localhost/PHP-2024/authenticate.php">Authenticate</a> |
    <a href="http://localhost/PHP-2024/login&Forms.php">Login & Forms</a> |
</header>
<section>
    <h2>MySQL en databases oefening 1</h2>
    <?php
    require_once 'db/login_users_test.php';

    function get_post($pdo, $var)
    {
        $inputValue = $pdo->quote($_POST[$var]);
        $inputValueNoSpaces = trim($inputValue);
        $inputValueNoSpacesNoQuotes = str_replace("'", "", $inputValueNoSpaces);
        return $inputValueNoSpacesNoQuotes;
    }

    try {
        $pdo = new PDO($attr, $user, $pass, $opts);
    }
    catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
    if (isset($_POST['name']) &&
        isset($_POST['email']) &&
        isset($_POST['password']))
    {
        $name = get_post($pdo, 'name');
        $email = get_post($pdo, 'email');
        $password = password_hash(get_post($pdo, 'password'), PASSWORD_DEFAULT);

        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $statement = $pdo->prepare($query);
        $statement->execute([
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);
    }
    echo <<<_END
    <form action="login&Forms.php" method="post"><pre>
         Name <input type="text" name="name">
        email <input type="text" name="email">
     password <input type="text" name="password">
              <input type="submit" value="Add User">
    </pre></form>
    _END;
    ?>
    <h3>Login to user</h3>
    <?php
    require_once 'db/login_users_test.php';

    try {
        $pdo = new PDO($attr, $user, $pass, $opts);
    }
    catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
    if (isset($_POST['name_login']) &&
        isset($_POST['password_login']))
    {
        $name = get_post($pdo, 'name_login');
        $password = get_post($pdo, 'password_login');

        $query = "SELECT name, password FROM users WHERE name = :name";
        $statement = $pdo->prepare($query);
        $statement->execute([
            'name' => $name
        ]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])) {
            echo "Login worked! Welcome " . $user['name'];
        } else {
            echo "Login failed.";
        }
    }
    echo <<<_END
    <form action="login&Forms.php" method="post"><pre>
         Name <input type="text" name="name_login">
     password <input type="text" name="password_login">
              <input type="submit" value="Login">
    </pre></form>
    _END;
    ?>
</section>
<section>
    <h2>Form Handeling</h2>
    <?php
    if(!empty($_POST['testName'])) {
        $testName = $_POST['testName'];
    } else {
        $testName = "(Not entered)";
    }
    echo <<<_END
<p>Your name is: $testName</p>
<form method="post" action="login&Forms.php">
    <div>What is your name?</div>
    <input type="text" name="testName">
    <input type="submit">
</form>
_END;

    ?>
</section>
