<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="surname">Surname:</label><br>
    <input type="text" name="surname" id="surname"
        value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>"><br><br>

    <label for="email">Email:</label><br>
    <input type="text" name="email" id="email"
        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"><br><br>

    <input type="submit" value="Submit">
</form>