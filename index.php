<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="./styles/desktop/home-page.css" />
	<link rel="stylesheet" href="./styles/desktop/icon-buttons.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Cutive+Mono&display=swap" rel="stylesheet" />
	<title>Ink Attitude, walk-in studio a Padova</title>
</head>

<body>
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
	if (!str_contains("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", "?lang=" . detect_language())) {
		switch (detect_language()) {
			case "en":
				header('Location: index.php?lang=en');
				break;
			case "it":
				header('Location: index.php?lang=it');
				break;
		}
	}
	function get_url_arg(string $url, string $arg_name): ?string
	{

		$query_string = parse_url($url, PHP_URL_QUERY);

		if (empty($query_string) || !is_string($query_string)) {
			return null;
		}

		parse_str($query_string, $query_args);

		return $query_args[$arg_name] ?? null;
	}

	switch (get_url_arg("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", "lang")) {
		case "en":
			require "locale/en.php";
			break;
		case "it":
		default:
			require "locale/it.php";
			break;
	}
	?>
</body>

</html>