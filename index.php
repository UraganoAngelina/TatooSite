<?php
define('SUPPORTED_LANGUAGES', ['en', 'it']);
function detect_language($fallback = 'it')
{
	foreach (preg_split('/[;,]/', $_SERVER['HTTP_ACCEPT_LANGUAGE']) as $sub) {
		if (substr($sub, 0, 2) == 'q=') continue;
		if (strpos($sub, '-') !== false) $sub = explode('-', $sub)[0];
		if (in_array(strtolower($sub), SUPPORTED_LANGUAGES)) return $sub;
	}
	return $fallback;
}

$language = detect_language();

switch ($language) {
	case "en":
		header('Location: en/index.php');
		break;
	case "it":
		header('Location: it/index.php');
		break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="refresh" content="5;url=<?php echo $language; ?>/index.php">
	<title>Redirecting...</title>
</head>

<body>
	<p>If you are not redirected automatically, follow this <a href="<?php echo $language; ?>/index.php">link</a>.</p>
</body>

</html>