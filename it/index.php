<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/home-page.css">
    <link rel="stylesheet" href="../styles/icon-buttons.css">
    <link rel="stylesheet" href="../styles/tattoo-styles.css">

    <link rel="stylesheet" href="../styles/scroll-bar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cutive+Mono&display=swap" rel="stylesheet">

    <title>Ink Attitude, walk-in studio a Padova</title>
    <link rel="alternate" href="https://inkattitude.it/en/" hreflang="en">
    <link rel="alternate" href="https://inkattitude.it/it/" hreflang="it">
    <link rel="canonical" href="https://inkattitude.it/en/">
</head>

<body>
    <header>
        <a href="https://inkattitude.it/en/" lang="en">English version</a>
        <h1 lang="en">Ink Attitude</h1>
        <p class="subtitle"><strong>Studio di tatuaggi</strong> <span lang="en">walk-in</span></p>
        <p class="subtitle">A <strong>Padova</strong></p>
    </header>
    <section id="fast-infos">
        <div>
            <a href="https://www.google.it/maps/place/Ink+Attitude+Tattoo+Studio/@45.4071589,11.8892417,17z/data=!3m1!4b1!4m6!3m5!1s0x477edb37d4b03feb:0x5a92f8dd7396e1b3!8m2!3d45.4071552!4d11.8918166!16s%2Fg%2F11swwy9kx_?entry=ttu" id="map">Apri con google maps.</a>
            <h2>Posizione</h2>
            <p>Via Giambattista Belzoni 143, zona <strong>Portello</strong> a Padova</p>
        </div>
        <div>
            <h2>Orari</h2>
            <p>LUN, MAR - SAB | 11 - 20</p>
            <p>MER | 11 - 22</p>
            <h2>Contatti</h2>
            <div>
                <a class="icon ig" href="https://www.instagram.com/inkattitude_tattoostudio/">@inkattitude_tattoostudio</a>
                <a class="icon pn" href="tel:+393755027462">3755027462</a>
            </div>
        </div>
    </section>
    <section id="crew">
        <h2 lang="en">Crew</h2>

        <?php
        // Open the artists folder
        $subfolders = glob('../artists/*', GLOB_ONLYDIR);
        // Randomize ordering of the directory
        shuffle($subfolders);


        $card_count = 0;
        $artists_order = [];

        echo "<div class='scroller'>";
        for ($i = 0; $i < 2; $i++) {
            foreach ($subfolders as $subfolder) {
                $json_files = glob($subfolder . '/*.json');

                if (count($json_files) === 1) {
                    // Extracting data
                    $data = json_decode(file_get_contents($json_files[0]), true);
                    $instagram_id = $data['it']['instagram_id'];
                    $bio = $data['it']['bio'];
                    $role = $data['it']['type'];
                    if (($role == "Ospite" && $i == 1) || ($role == "Residente" && $i == 0)) {

                        $styles = $data['it']['styles'];

                        $profile_pic_b64 = $data['profile_pic'];
                        $alt_attr = $data['it']['alt'];

                        // Print element
                        echo "
                        <div id='" . $card_count . "' class='crew-member'>
                            <h3><a href='https://www.instagram.com/" . $instagram_id . "' target='_blank' >@" . $instagram_id . "</a></h3>
                            <div class='description'>
                                <img src='data:image/jpeg;base64," . htmlspecialchars($profile_pic_b64) . "' alt='" . $alt_attr . "' >
                                <h4>" . $role . "</h4>
                                <p>" . $bio . "</p>
                            </div>
                            <ul aria-label='Spcializzato in' class='styles-array'>";

                        foreach ($styles as $style) echo "<li class='style " . str_replace(" ", "-", strtolower($style))  . "' lang='en'>" . $style . "</li>";

                        echo "
                            </ul>
                        </div>";

                        $card_count++;
                        array_push($artists_order, $instagram_id);
                    }
                }
            }
        }
        // Print in order 
        echo "
			</div>
			<ul>
		";
        for ($i = 0; $i < $card_count; $i++) {
            echo "<li><a href='#" . $i . "' aria-label='Vedi artista'>" . $artists_order[$i] . "</a></li>";
        }
        echo "</ul>";
        ?>

    </section>
    <section id="portfolio">
        <h2>Galleria</h2>
        <?php
        foreach ($subfolders as $subfolder) {

            $artist_ig = end(explode('/', $subfolder));
            $portfolio_dir = glob($subfolder . "/*", GLOB_ONLYDIR);

            if (count($portfolio_dir) == 1) {
                $files = scandir($portfolio_dir[0]);
                if (count($files) > 2) {
                    echo "
                    <div>
                        <h3><a href='https://www.instagram.com/$artist_ig' target='_blank'>@$artist_ig</a></h3>
                        <div>";

                    foreach ($files as $file) {
                        $file_path = $portfolio_dir[0] . "/" . $file;
                        if ($file !== "." && $file !== "..") {
                            echo "<div><img src='$file_path' alt=\"Uno dei lavori di $artist_ig\"></div>";
                        }
                    }
                    echo " 
                    </div>
                        </div>";
                }
            }
        }
        ?>
    </section>
    <hr>
    <footer>
        <div id="shop-info">
            <div>
                <h3>Posizione</h3>
                <p>Via G.Belzoni 143/145</p>
            </div>
            <div>
                <h3>Orari</h3>
                <p>LUN, MAR - SAB | 11 - 20</p>
                <p>MER | 11 - 22</p>
            </div>
        </div>
        <div id="contacts">
            <h3>Contatti</h3>
            <div>
                <a class="icon ig" href="https://www.instagram.com/inkattitude_tattoostudio/" aria-label="Pagina instagram dello studio">@inkattitude_tattoostudio</a>
                <a class="icon pn" href="tel:+393755027462" aria-label="Numero di telefono dello studio">3755027462</a>
            </div>
        </div>
        <div id="legal">
            <h3>Legale</h3>
            <a href="privacy-policy.html">Polizza sulla privacy</a>
            <a href="service-terms.html">Termini di servizio</a>
            <a href="credits.html">Crediti</a>
        </div>
    </footer>
    <hr>
    <script>
        window.addEventListener('load', function() {
            // Fetch the current page content
            fetch(window.location.href)
                .then(response => response.text())
                .then(pageContent => {
                    // Send the page content to the W3C Validator
                    return fetch('https://validator.w3.org/nu/?out=json', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'text/html; charset=utf-8'
                        },
                        body: pageContent
                    });
                })
                .then(response => response.json())
                .then(validationResults => {
                    // Handle the validation results
                    console.log(validationResults);
                    // Optionally display the results on the page
                    if (validationResults['messages'].length == 0) {
                        console.log('okey');
                        const successMessage = document.createElement('p');
                        successMessage.innerHTML = 'This page has been successfully validated by the <a href="https://www.w3.org/" target="_blank">W3C</a> Validator.';
                        successMessage.style.fontSize = 'small';
                        document.body.appendChild(successMessage);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>