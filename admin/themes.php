<?php
if(isset($_POST['theme'])){
    $_SESSION['theme'] = $_POST['theme'];
}
?>

<h2>Select Theme</h2>

<form method="POST">
    <label>
        <select name="theme">
            <option value="theme-default.css">Default</option>
            <option value="theme-dark.css">Dark</option>
            <option value="theme-holiday.css">Holiday</option>
        </select>
    </label>

    <button type="submit">Apply Theme</button>
</form>