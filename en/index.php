<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../styles/home-barrel.css">

    <link rel="apple-touch-icon" sizes="180x180" href="../media/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../media/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../media/favicon/favicon-16x16.png">
    <link rel="manifest" href="../site.webmanifest">


    <title>Ink Attitude, walk-in studio a Padova</title>
    <link rel="alternate" href="https://inkattitude.it/en/" hreflang="en">
    <link rel="alternate" href="https://inkattitude.it/it" hreflang="it">
    <link rel="canonical" href="https://inkattitude.it/en/">
</head>

<body>
    <header>
        <a id="language-switch" class="icon it" href="../it/" lang="it">Versione in italiano</a>
        <h1>Ink Attitude</h1>
        <p class="subtitle">Walk-in <strong>tattoo studio</strong></p>
        <p class="subtitle">In <strong>Padua</strong></p>
    </header>
    <section id="fast-infos">
        <div>
            <a href="https://www.google.it/maps/place/Ink+Attitude+Tattoo+Studio/@45.4071589,11.8892417,17z/data=!3m1!4b1!4m6!3m5!1s0x477edb37d4b03feb:0x5a92f8dd7396e1b3!8m2!3d45.4071552!4d11.8918166!16s%2Fg%2F11swwy9kx_?entry=ttu" id="map">Open in maps.</a>
            <h2>Location</h2>
            <p><span lang="it">Giambattista Belzoni</span> 143 <strong lang="it">Portello</strong>, Padua</p>
        </div>
        <div>
            <h2>Opening hours</h2>
            <p>MON, TUE - SAT | 11 to 20</p>
            <p>WED | 11 to 22</p>
            <h2>Contacts</h2>
            <div>
                <a class="icon ig" href="https://www.instagram.com/inkattitude_tattoostudio/">@inkattitude_tattoostudio</a>
                <a class="icon pn" href="tel:+393755027462">3755027462</a>
            </div>
        </div>
    </section>
    <section id="crew">
        <h2>Artists</h2>

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
                    $instagram_id = $data['en']['instagram_id'];
                    $bio = $data['en']['bio'];
                    $role = $data['en']['type'];
                    if (($role == "Guest" && $i == 1) || ($role == "Resident" && $i == 0)) {

                        $styles = $data['en']['styles'];

                        $profile_pic_b64 = $data['profile_pic'];
                        $alt_attr = $data['en']['alt'];

                        // Print element
                        echo "
                        <div id='" . $card_count . "' class='crew-member'>
                            <h3><a href='https://www.instagram.com/" . $instagram_id . "' target='_blank' >@" . $instagram_id . "</a></h3>
                            <div class='description'>
                                <img src='data:image/jpeg;base64," . htmlspecialchars($profile_pic_b64) . "' alt='" . $alt_attr . "' >
                                <h4>" . $role . "</h4>
                                <p>" . $bio . "</p>
                            </div>
                            <ul aria-label='Specialized in' class='styles-array'>
                            ";
                        foreach ($styles as $style) echo "<li class='style " . str_replace(" ", "-", strtolower($style))  . "'>" . $style . "</li>";
                        echo "
                            </ul>
                        </div>";

                        $card_count++;
                        array_push($artists_order, $instagram_id);
                    }
                }
            }
        }
        // Print in order of
        echo "
			</div>
			<ul>
		";
        for ($i = 0; $i < $card_count; $i++) {
            echo "<li><a href='#" . $i . "' aria-label='Go to artist'>" . $artists_order[$i] . "</a></li>";
        }
        echo "</ul>";
        ?>

    </section>
    <section id="portfolio">
        <h2 lang="en">Gallery</h2>
        <?php
        foreach ($subfolders as $subfolder) {

            $exploded = explode('/', $subfolder);
            $artist_ig = end($exploded);
            $portfolio_dir = glob($subfolder . "/*", GLOB_ONLYDIR);

            if (count($portfolio_dir) == 1) {
                $files = scandir($portfolio_dir[0]);
                if (count($files) > 2) {
                    echo "
                    <div>
                        <h3><a href='https://www.instagram.com/$artist_ig'>@$artist_ig</a></h3>
                        <div>";

                    foreach ($files as $file) {
                        $file_path = $portfolio_dir[0] . "/" . $file;
                        if ($file !== "." && $file !== "..") {
                            echo "<div><img src='$file_path' alt='Some work of $artist_ig'></div>";
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
                <h3>Location</h3>
                <p>Via G.Belzoni 143/145</p>
            </div>
            <div>
                <h3>Opening hours</h3>
                <p>MON, TUE - SAT | 11 to 20</p>
                <p>WED | 11 to 22</p>
            </div>
        </div>
        <div id="contacts">
            <h3>Contacts</h3>
            <div>
                <a class="icon ig" href="https://www.instagram.com/inkattitude_tattoostudio/" aria-label="Shop's intagram page">@inkattitude_tattoostudio</a>
                <a class="icon pn" href="tel:+393755027462" aria-label="Shop's phone number">3755027462</a>
            </div>
        </div>
        <div id="legal">
            <h3>Legal</h3>
            <a href="./privacy-policy.html">Privacy policy</a>
            <a href="./service-terms.html">Terms of service</a>
            <a href="./credits.html">Credits</a>
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
                    if (validationResults['messages'].length == 0) {
                        const successMessage = document.createElement('p');
                        successMessage.innerHTML = 'This page has been successfully validated by the <a href="https://www.w3.org/" target="_blank">W3C</a> Validator.';
                        successMessage.style.fontSize = 'small';
                        successMessage.style.width = "90vw";
                        successMessage.style.margin = "10px auto";
                        successMessage.style.textAlign = "center";
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