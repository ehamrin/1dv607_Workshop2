<?php


namespace view;


class HTMLView
{
    public function Render($body){
        echo '
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Workshop 2</title>
</head>
<body>
    ' . $body . '
</body>
</html>
        ';
    }
}