<html>
<head>
    <title>ADMIN PANEL : Sołectwo Nowe Smolno : <?php echo $title ?></title>
    <link rel="Stylesheet" type="text/css" href=<?php echo base_url() . "assets/css/style.css" ?> />
    <link rel="icon" type="image/gif" href=<?php echo base_url() . "assets/img/ico.png" ?> />
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <meta charset="UTF-8" />
</head>
<body>
    <div id="headCont">
        <header>
                <a href=<?php echo base_url() ?>>
                    <img src= <?php echo base_url() . "assets/img/NoweSmolno.png" ?> />
                </a>
                <a href=<?php echo base_url() . "index.php/admin/logout"?> >Wyloguj</a>
        </header>
        <nav>
        <ul>
            <li><a href=<?php echo base_url() . "index.php/admin/panel" ?>>Newsy</a>
            <ul>
                <li><a href=<?php echo base_url() . "index.php/news/create" ?>>Dodaj</a></li>
                <li><a href=<?php echo base_url() . "index.php/news/edit" ?>>Edytuj</a></li>
            </ul>
            </li>
        </ul>
        </nav>
    </div>
