<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Snake （@ChangJJ）</title>
    <link href="/Public/GAME/snake/css/snake.css" rel="stylesheet">
    <script src="/Public/GAME/snake/js/snake.js" type="text/javascript"></script>
</head>
<body onload="init()">
    <section id="mainWindow">
        <header id="score"><span>难 度: </span><span id="levelNum">1</span><br/><br/><span>分 数: </span><span id="scoreNum">0</span></header>
        <h1 id="hintShow"></h1>
    </section>
</body>
</html>