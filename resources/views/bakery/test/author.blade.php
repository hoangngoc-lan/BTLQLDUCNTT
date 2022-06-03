

      @extends('bakery.layout.master')
@section('title')
    Category
@endsection

@section('content')
	
	<section id="section0" class="slider-area">
	    <div class="main-slider owl-theme owl-carousel">
	        <!-- Start Slingle Slide -->
	        <div class="single-slide item"
	            style="background-image: url(/bakery/img/slider/trang-web-doc-sach-online-mien-phi.jpg);background-size: 100% 100%;">


	            <!-- <img src="img/slider/placehold.png"> -->

	            <!-- Start Slider Content -->

	            
	            <!-- Start Slider Content -->
	        </div>
	        <!-- End Single Slide -->
	        <!-- Start Slingle Slide -->
	        <div class="single-slide item"
	            style="background-image: url(/bakery/img/slider/bai-dien-thuyet-ngay-hoi-doc-sach-va-trung-bay-gioi-thieu-sach-600.jpg);background-size: 100% 100%;">

	            <!-- <img src="img/slider/bakery.jpg"> -->
	            <!-- Start Slider Content -->

	            
	            <!-- Start Slider Content -->
	        </div>

	        <div class="single-slide item"
	            style="background-image: url(/bakery/img/slider/cropped-chashka-blyudce-kruzhka-chay-vecher.jpg);background-size: 100% 100%;">

	            <!--<img src="img/slider/bakery.jpg">-->
	            <!-- Start Slider Content -->

	            
	            <!-- Start Slider Content -->
	        </div>
	    </div>

	</section>

	
	<section class="fh5co-about-me">
		<div class="about-me-inner site-container">
			<article class="portfolio-wrapper">
				<div class="portfolio__img">
					<img src="./bakery/img/aboutme/about-me.jpg" class="about-me__profile" alt="about me profile picture">
				</div>
				<div class="portfolio__bottom">
					<div class="portfolio__name">
						<span>J</span>
						<h2 class="universal-h2">hone Smith</h2>
					</div>
					<p>Jhone Smith is a short story author, novelist, and award-winning poet.</p>
				</div>
			</article>
			<div class="about-me__text" >
				<div class="about-me-slider">
					<div class="about-me-single-slide">
						<h2 class="universal-h2 universal-h2-bckg">About me</h2>
						<p><span>H</span> e has work appearing or forthcoming in over a dozen venues, including Buzzy Mag, The Spirit of Poe, and the British Fantasy Society journal Dark Horizons. He is also CEO of a company, specializing in custom book publishing and social media marketing services, have created a community for authors to learn and connect.He has work appearing or forthcoming in over a dozen venues, including Buzzy Mag, The Spirit of Poe, and have created a community for authors to learn and connect.</p>
						<h4>Author</h4>
						<p class="p-white">See me</p>
					</div>
					<div class="about-me-single-slide">
						<h2 class="universal-h2 universal-h2-bckg">About me 2</h2>
						<p><span>H</span> e has work appearing or forthcoming in over a dozen venues, including Buzzy Mag, The Spirit of Poe, and the British Fantasy Society journal Dark Horizons. He is also CEO of a company, specializing in custom book publishing and social media marketing services, have created a community for authors to learn and connect.He has work appearing or forthcoming in over a dozen venues, including Buzzy Mag, The Spirit of Poe, and have created a community for authors to learn and connect.</p>
						<h4>Author</h4>
						<p class="p-white">See me</p>
					</div>
				</div>
			</div>
		</div>
		<div class="about-me-bckg" style="background-image: url(/bakery/img/aboutme/about-me-bckg.jpg);background-size: 100% 100%;"></div>
	</section>
	<section class="fh5co-books">
		<div class="site-container">
			<h2 class="universal-h2 universal-h2-bckg">New Books </h2>
			<div class="books">
				<div class="single-book">
					<a href="{{ route('bakery.Details.bookdetail') }}" class="single-book__img">
						<img src="./bakery/img/book/books-1.jpg" alt="single book and cd">
						<div class="single-book_download">
							<img src="./bakery/img/svg/download.svg" alt="book image">
						</div>
					</a>
					<h4 class="single-book__title">Olivani</h4>
					<span class="single-book__price">$15.00</span>
					<!-- star rating -->
					<div class="rating">
						<span>&#9734;</span>
						<span>&#9734;</span>
						<span>&#9734;</span>
						<span>&#9734;</span>
						<span>&#9734;</span>
					</div>
					<!-- star rating end -->
				</div>
				<div class="single-book">
					<a href="#" class="single-book__img">
						<img src="./bakery/img/book/books-2.jpg" alt="single book and cd">
						<div class="single-book_download">
							<img src="./bakery/img/svg/download.svg" alt="book image">
						</div>
					</a>
					<h4 class="single-book__title">Molleon’s Life</h4>
					<span class="single-book__price">$22.00</span>
					<!-- star rating -->
					<div class="rating">
						<span>&#9734;</span>
						<span>&#9734;</span>
						<span>&#9734;</span>
						<span>&#9734;</span>
						<span>&#9734;</span>
					</div>
					<!-- star rating end -->
				</div>
				<div class="single-book">
					<a href="#" class="single-book__img">
						<img src="./bakery/img/book/books-3.jpg" alt="single book and cd">
						<div class="single-book_download">
							<img src="./bakery/img/svg/download.svg" alt="book image">
						</div>
					</a>
					<h4 class="single-book__title">Love is Love</h4>
					<span class="single-book__price">$25.00</span>
				</div>
				<div class="single-book">
					<a href="#" class="single-book__img">
						<img src="./bakery/img/book/books-4.jpg" alt="single book and cd">
						<div class="single-book_download">
							<img src="./bakery/img/svg/download.svg" alt="book image">
						</div>
					</a>
					<h4 class="single-book__title">Give Me Also</h4>
					<span class="single-book__price">$30.00</span>
				</div>
			</div>
			<div class="books-brand-button">
				<a href="#" class="brand-button">View more</a>
			</div>
		</div>
	</section>
	<div class="fh5co-counter counters">
		<div class="counter-inner site-container">
			<div class="single-count">
				<span class="count" data-count="50">0</span>
				<div class="single-count__text">
					<img src="./bakery/img/counter/counter-1.png" alt="counter icon">
					<p>Books</p>
				</div>
			</div>
			<div class="single-count">
				<span class="count" data-count="600">0</span>
				<div class="single-count__text">
					<img src="./bakery/img/counter/counter-2.png" alt="counter icon">
					<p>Pages</p>
				</div>
			</div>
			<div class="single-count">
				<span class="count" data-count="2000">0</span>
				<div class="single-count__text">
					<img src="./bakery/img/counter/counter-3.png" alt="counter icon">
					<p>Sales</p>
				</div>
			</div>
			<div class="single-count">
				<span class="count" data-count="125">0</span>
				<div class="single-count__text">
					<img src="./bakery/img/counter/counter-4.png" alt="counter icon">
					<p>Awards</p>
				</div>
			</div>
		</div>
	</div>
	<section class="fh5co-blog">
		<div class="site-container">
			<h2 class="universal-h2 universal-h2-bckg">My Blog</h2>
			<div class="blog-slider blog-inner">
				<div class="single-blog">
					<div class="single-blog__img">
						<img src="./bakery/img/myblog/blog1.jpg" alt="blog image">
					</div>
					<div class="single-blog__text">
						<h4>The Journey Under the Waves</h4>
						<span>On August 28, 2015</span>
						<p>Quisque vel sapi nec lacus adipis cing bibendum nullam porta lites laoreet aliquam.velitest, tempus a ullamcorper et, lacinia mattis mi. Cras arcu nulla, blandit id cursus et, ultricies eu leo.</p>
					</div>
				</div>
				<div class="single-blog">
					<div class="single-blog__img">
						<img src="./bakery/img/myblog/blog2.jpg" alt="blog image">
					</div>
					<div class="single-blog__text">
						<h4>The Journey Under the Waves</h4>
						<span>On August 28, 2015</span>
						<p>Quisque vel sapi nec lacus adipis cing bibendum nullam porta lites laoreet aliquam.velitest, tempus a ullamcorper et, lacinia mattis mi. Cras arcu nulla, blandit id cursus et, ultricies eu leo.</p>
					</div>
				</div>
				<div class="single-blog">
					<div class="single-blog__img">
						<img src="./bakery/img/myblog/blog2.jpg" alt="blog image">
					</div>
					<div class="single-blog__text">
						<h4>The Journey Under the Waves</h4>
						<span>On August 28, 2015</span>
						<p>Quisque vel sapi nec lacus adipis cing bibendum nullam porta lites laoreet aliquam.velitest, tempus a ullamcorper et, lacinia mattis mi. Cras arcu nulla, blandit id cursus et, ultricies eu leo.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Blog end -->

	<!-- Quotes -->
	<section class="fh5co-quotes" style="background-image: url(/bakery/img/aboutme/quotes-bckg.jpg);background-size: 100% 100%;">
		<div class="site-container">
			<div class="about-me-slider">
				<div>
					<h2 class="universal-h2 universal-h2-bckg">What People Are Saying</h2>
					<p>“Pudding croissant cake candy canes fruitcake sweet roll pastry gummies sugar plum. Tart pastry danish soufflé donut bear claw chocolate cake marshmallow chupa chups. Jelly danish gummi bears cake donut powder chocolate cake. Bonbon soufflé lollipop biscuit dragée jelly-o. Wafer pastry pudding tiramisu chocolate bar croissant cake. Pie caramels gummies danish.”</p>
					<img src="./bakery/img/svg/quotes.svg" alt="quotes svg">
					<h4>David Dixon</h4>
					<p>Reader</p>
				</div>
				<div>
					<h2 class="universal-h2 universal-h2-bckg">What People Are Saying 2</h2>
					<p>“Pudding croissant cake candy canes fruitcake sweet roll pastry gummies sugar plum. Tart pastry danish soufflé donut bear claw chocolate cake marshmallow chupa chups. Jelly danish gummi bears cake donut powder chocolate cake. Bonbon soufflé lollipop biscuit dragée jelly-o. Wafer pastry pudding tiramisu chocolate bar croissant cake. Pie caramels gummies danish.”</p>
					<img src="./bakery/img/svg/quotes.svg" alt="quotes svg">
					<h4>David Dixon</h4>
					<p>Reader</p>
				</div>
			</div>
		</div>
	</section>
	<!-- Quotes end -->

	<!-- Social -->
	<section class="fh5co-social" style="background-image: url(/bakery/img/social/social-bckg.jpg);background-size: 100% 100%;">
		<div class="site-container">
			<div class="social">
				<h5>Follow me!!</h5>
				<div class="social-icons">
					<a href="#" target="_blank"><img src="./bakery/img/social/social-twitter.png" alt="social icon"></a>
					<a href="#" target="_blank"><img src="./bakery/img/social/social-pinterest.png" alt="social icon"></a>
					<a href="#" target="_blank"><img src="./bakery/img/social/social-youtube.png" alt="social icon"></a>
					<a href="#" target="_blank"><img src="./bakery/img/social/social-twitter.png" alt="social icon"></a>
				</div>
				<h5>Share it!</h5>
			</div>
		</div>
	</section>
	<!-- Social -->
@endsection

@push ('scripts')
@endpush