<header>
    <h1>Ink Attitude</h1>
    <p class="subtitle"><strong>studio di tatuaggi</strong> <span lang="en">walk-in</span></p>
    <p class="subtitle">A <strong>Padova</strong></p>
</header>
<section id="fast-infos">
    <div>
        <a href="https://www.google.it/maps/place/Ink+Attitude+Tattoo+Studio/@45.4071589,11.8892417,17z/data=!3m1!4b1!4m6!3m5!1s0x477edb37d4b03feb:0x5a92f8dd7396e1b3!8m2!3d45.4071552!4d11.8918166!16s%2Fg%2F11swwy9kx_?entry=ttu" id="map">Apri con google maps.</a>
        <h2>Posizione</h2>
        <p>Via Giambattista Belzoni 143 <strong>Portello</strong> a Padova</p>
    </div>
    <div>
        <h2>Orari</h2>
        <p>LUN, MAR - SAB | 11 to 20</p>
        <p>MER | 11 to 22</p>
        <h2>Contatti</h2>
        <div>
            <a class="icon ig" href="https://www.instagram.com/inkattitude_tattoostudio/">@inkattitude_tattoostudio</a>
            <a class="icon pn" href="tel:+393755027462">3755027462</a>
        </div>
    </div>
</section>
<section id="crew">
    <h2 lang="en">Artists</h2>

    <?php
    // Open the artists folder
    $subfolders = glob('./artists/*', GLOB_ONLYDIR);
    // Randomize ordering of the directory
    shuffle($subfolders);

    echo "<div class='scroller'>";

    $card_count = 0;
    $artists_order = [];

    foreach ($subfolders as $subfolder) {
        $json_files = glob($subfolder . '/*.json');

        if (count($json_files) === 1) {
            // Extracting data
            $data = json_decode(file_get_contents($json_files[0]), true);
            $instagram_id = $data['instagram_id'];
            $styles = $data['styles'];
            $profile_pic_b64 = $data['profile_pic'];
            $alt_attr = $data['alt'];

            // Print element
            echo "
					<div id='" . $card_count . "' class='crew-member'>
						<h3><a href='https://www.instagram.com/" . $instagram_id . "' target='_blank' >@" . $instagram_id . "</a></h3>
						<div class='description'>
							<img src='data:image/jpeg;base64," . htmlspecialchars($profile_pic_b64) . "' alt='" . $alt_attr . "' />
							<p>Lorem i adipisci beatae odio! Ad nobis laudantium cum mollitia aut minus harum sunt fuga.</p>
						</div>
						<ul aria-label='specializzazione' class='styles-array'>
							<li class='style traditional' lang='en'>Traditional</li>
						</ul>
					</div>";
        }

        $card_count++;
        array_push($artists_order, $instagram_id);
    }
    // Print in order of
    echo "
			</div>
			<ul>
		";
    for ($i = 0; $i < $card_count; $i++) {
        echo "<li><a href='#" . $i . "'>" . $artists_order[$i] . "</a></li>";
    }
    echo "</ul>";
    ?>
    </div>

</section>
<section id="portfolio">
    <h2 lang="en">Gallery</h2>
    <div>
        <h3>Cogue</h3>
        <div>
            <?php
            $files = scandir('../media/images/coguer_tattoo');
            foreach ($files as $file) {
                if ($file !== "." && $file !== "..") {
                    echo "<div><img src='./media/images/coguer_tattoo/$file'/></div>";
                }
            } ?>
        </div>
    </div>
    <div>
        <h3>Damiano</h3>
        <div>
            <?php
            $files = scandir('../media/images/damiano_buffa');
            foreach ($files as $file) {
                if ($file !== "." && $file !== "..") {
                    echo "<div><img src='./media/images/damiano_buffa/$file'/></div>";
                }
            } ?>
        </div>
    </div>
    <div>
        <h3>Jacopo</h3>
        <div>
            <?php
            $files = scandir('./media/images/jacopo_blueink');
            foreach ($files as $file) {
                if ($file !== "." && $file !== "..") {
                    echo "<div><img src='./media/images/jacopo_blueink/$file'/></div>";
                }
            } ?>
        </div>
    </div>
</section>
<hr>
<footer>
    <div id="shop-info">
        <div>
            <h3>Posizione</h3>
            <p>Via G.Belzoni 143/145</p>
        </div>
        <div>
            <h3>Orari di apertura</h3>
            <p>LUN, MAR - SAB | 11 to 20</p>
            <p>MER | 11 to 22</p>
        </div>
    </div>
    <div id="contacts">
        <h3>Contatti</h3>
        <div>
            <a class="icon ig" href="https://www.instagram.com/inkattitude_tattoostudio/">@inkattitude_tattoostudio</a>
            <a class="icon pn" href="tel:+393755027462">3755027462</a>
        </div>
    </div>
    <div id="legal">
        <h3>Legale</h3>
        <a href="./privacy-policy.html">Privacy police</a>
        <a href="./service-terms.html">Terms of service</a>
        <a href="./credits.html">Credits</a>
    </div>
</footer>
<hr>