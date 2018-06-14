@php
$routePrefix = Route::getCurrentRoute()->getPrefix();
@endphp
	<section id="coordinates" class="container-fluid bgBlue">
			<div class="container">
				<div class="row">
					<section class="col-md-6 col-lg-3">
						
						<h2>Coordonnée</h2>
						<p><i class="fas fa-map-marker-alt"></i>&nbsp;0123&nbsp;Rue, De La&nbsp;Gare, Auxerre&nbsp;89000</p>
						<p><i class="fas fa-phone"></i>&nbsp;(+33)&nbsp;386010203</p>
						<p><i class="fas fa-envelope"></i>&nbsp;info@psdfreebies.com</p>
					</section>
					<section class="col-md-6 col-lg-3">
						<h2>Information</h2>
						<p><a href="{{ route('vie_privee') }}">Politique & Confidentialité</a></p>

						<p><a href="{{ route('m_l') }}">Mentions Légales</a></p>
						<p>Expédition & Livraison</p>
						<p>FAQs</p>
					</section>
					<section class="col-md-6 col-lg-3">
						<h2>Réseaux Sociaux</h2>
						<div class="row">
							<div class="col">
								<p><i class="fab fa-google-plus-g"></i>&nbsp;Google+</p>
								<p><i class="fab fa-pinterest-p"></i>&nbsp;Pinterest</p>
								<p><i class="fab fa-vimeo-v"></i>&nbsp;Vimeo</p>
								<p><i class="fab fa-instagram"></i>&nbsp;Instagram</p>
							</div>
							<div class="col">
								<p><i class="fab fa-facebook-f"></i>&nbsp;Facebook</p>
								<p><i class="fab fa-twitter"></i>&nbsp;Twitter</p>
								<p><i class="fas fa-rss"></i>&nbsp;Rss</p>
								<p><i class="fab fa-youtube"></i>&nbsp;Youtube</p>
							</div>
						</div>
					</section>
					<section class="col-md-6 col-lg-3">


						<h2>Modalité de paiement</h2>
						<p><i class="fab fa-cc-visa"></i> Carte VISA</p>
						<p><i class="fab fa-cc-paypal"></i> PayPal</p>
						<p><i class="fab fa-cc-amex"></i> American Express</p>
						<p></p>
					</section>		
				</div>
			</div><!-- /container -->
		</section><!-- /container-fluid -->

		
		<footer class="container-fluid bgBlue">
			<nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent3" aria-controls="navbarSupportedContent3" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent3">
					<ul class="navbar-nav mx-auto">
						<li class="nav-item">
							<a class="nav-link" href="#">Localisation</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Recherche</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Advance</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="#">Contact</a>
						</li>
					</ul>
				</div>
			</nav>
			<p>&copy; 2018 HTEV</p>
		</footer>
	</body>
	</html>