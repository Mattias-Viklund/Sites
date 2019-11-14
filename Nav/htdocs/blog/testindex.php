<?php
// Initialize the session
session_start();

$is_user = $is_admin = false;
$resultsperpage = 5;
$page = 0;

if (isset($_SESSION['acctype'])) {
    $is_user = true;
    $is_admin = (($_SESSION['acctype'] == 0) ? true : false);
}

if (isset($_GET['page'])) {
    $page = $_GET["page"];
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        body {
            color: #c6c2ba;
            background-color: #000;

        }

        a {
            color: #dab66c;
            text-decoration: none;

        }

        .post {
            padding: 0px;
            margin: 0px;

        }

        .links {
            padding: 25px;
            display: block;
        }

        .links a {
            margin-right: 15px;
        }

        hr {
            background-color: #FFF;
        }

        .categories {
            border-right: solid 1px #FFF;
        }

        .categories ul {
            list-style: none;
            display: inline;
        }

        .post h3 {
            color: #79aadd;
        }

        .post h5 {
            color: #496685;
        }

        .admin_tools {
            display: inline;
            padding: 5px 16px 10px 0px;

        }

        .admin_tools a {
            padding: 5px 0px 5px 10px;

        }

        .m-dark {
            background-color: #101010;

        }

        .m-dark .navbar-brand {
            color: #FFF;

        }

        .m-shade {
            text-shadow: 2px 2px 8px #79aadd;
        }
    </style>

</head>

<body>
    <a href="#"><img src="img/title.png" width="512px" /></a>
    <nav class="navbar navbar-expand-md m-dark">
        <a class="navbar-brand m-shade" href="#">EXEDUMP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#">HOME</a></li>
                <li class="nav-item"><a class="nav-link" href="#">BLOG</a></li>
                <li class="nav-item"><a class="nav-link" href="#">DOWNLOADS</a></li>

            </ul>
        </div>
    </nav><br>

    <?php
    require_once("../config.php");
    require_once('HTML/BBCodeParser2.php');
    $config = parse_ini_file('BBCodeParser2.ini', true);
    $options = $config['HTML_BBCodeParser2'];
    $parser = new HTML_BBCodeParser2($options);
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 categories">
                <h3 class="m-shade">Categories</h3>
                <hr>
                <ul>
                    <li><a href="#">Making the Blog</a></li>
                    <li><a href="#">Grapple Guy</a></li>
                    <li><a href="#">Overlord</a></li>

                </ul>
            </div>

            <div class="col-sm-10">
                <h3 class="m-shade">Recent Posts</h3>
                <hr>
                <div class="post">
                    <?php
                    require_once("articles.php");
                    $articles = articles_load($link, $resultsperpage, $resultsperpage * $page);
                    if (is_array($articles) || is_object($articles)) {
                        foreach ($articles as $article) {
                            echo '<div class="post">';

                            echo '<h3>' . $article["title"] . '</h3>';
                            echo '<h5>' . $article["date"] . (($article["worktime"] > 0) ? ", Worked for " . $article["worktime"] . " hours." : "") . '</h5>';

                            if (!empty($article["thumbnail"]))
                                echo '<img src="' . $article["thumbnail"] . '" width="256" alt="Click to open full image."">';

                            $parser->setText($article['content']);
                            $parser->parse();
                            $parsed = $parser->getParsed();

                            echo '<p>' . nl2br($parsed) . '</p>';
                            echo '<br>';

                            if (!empty($article["git_commit"])) {
                                echo '<a href="' . $article["git_commit"] . '">Github Commit</a>';
                                echo '<br>';
                            }

                            echo '<a href="comment.php?id=' . $article["id"] . '">Comment</a>';

                            if ($is_admin) {
                                echo '<br>';
                                echo '<div class="admin_tools">';
                                echo '<b>Admin Tools</b>';
                                echo '<a href="admin/edit.php?id=' . $article["id"] . '">Edit</a>';
                                echo '<a href="admin/delete.php?id=' . $article["id"] . '">Remove</a>';
                                echo '</div>';
                            }
                            echo '</div>';
                            echo '<hr>';
                        }
                    }
                    ?>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>
</body>

<footer>
    <div class="links fixed-bottom">
        <a href="#">Github</a>
        <a href="#">Twitter</a>
        <a href="#">Steam</a>

    </div>
</footer>

</html>