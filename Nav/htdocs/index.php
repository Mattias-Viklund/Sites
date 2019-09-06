<?php
session_start();
require_once("config.php");

require_once('HTML/BBCodeParser2.php');
/* get options from the ini file */
$config = parse_ini_file('BBCodeParser2.ini', true);
$options = $config['HTML_BBCodeParser2'];
/* do yer stuff! */
$parser = new HTML_BBCodeParser2($options);

?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf8">
<title>Index</title>
</head>

<body>
<p>Posties.</p>
<div>
<?php
require_once("articles.php");
$articles = articles_load($link);
if (is_array($articles) || is_object($articles)) {
foreach ($articles as $article) {
echo '<p>' . $article["title"] . '</p>';
echo '<img src="' . $article["thumbnail"] . '" height="256" width="256" alt="Click to open full image."">';

$parser->setText($article['content']);
$parser->parse();
$parsed = $parser->getParsed();

echo '<p>' . nl2br($parsed) . "</p>";
}
}
?>
</div>
</body>

</html>
