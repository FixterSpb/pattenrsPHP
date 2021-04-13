<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Проводник</h1>
        <h2><?=$directory->getPathInfo()?></h2>
    </header>
    <div class="content">

        <?php foreach ($directory as $dir): ?>
        <?php if($dir == '.') continue;?>
            <a class="item" href="/?path=<?=$dir->getType() === 'dir' ? $dir->getRealPath() : $directory->getPathInfo()?>">
                <img src="/img/<?=$dir->getType()?>.png" alt="directory">
                <p class="dir-name"><?=$dir?></p>
            </a>

        <?php endforeach; ?>
    </div>
</body>
</html>
<?php

    
