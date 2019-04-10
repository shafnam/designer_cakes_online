	<div class="my-bg">

		<div class="mb-0">
    
			<!-- Logo -->		
			<img class="mx-auto d-block mb-1" src="img/cake-icon.png">  
			<h1 class="pb-3"> <!-- Designer Cakes Toowoomba-->
				<a href="index.php" class="d-flex justify-content-center pt-3">Designer Cakes Toowoomba</a> 
			</h1>

		</div>
		
		<div class="container-fluid header" id="mainHeader">

			<nav class="navbar navbar-expand-lg navbar-light mainmenu justify-content-center">
				
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbar">
					<ul class="navbar-nav mx-auto text-center">
						
						<li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '');?>">
							<a href="index.php">Home</a>
						</li>				 
						<li class="nav-item dropdown megamenu-li <?php echo (basename($_SERVER['PHP_SELF']) == 'cake-designs.php' ? 'active' : '');?>">
							<a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Designs</a>
							<div class="dropdown-menu megamenu mx-auto p-5" aria-labelledby="dropdown01">
								<div class="row">
									<div class="col-sm-6 col-lg-3">
										<!-- <img src="https://img1.cookinglight.timeinc.net/sites/default/files/styles/medium_2x/public/1542062283/chocolate-and-cream-layer-cake-1812-cover.jpg?itok=rEWL7AIN" style="width: 75%;"> -->
									</div>
									<div class="col-sm-6 col-lg-3">
										<!-- <img src="img/gallery/Hatchimals Cake/5.jpg" alt="..." style="width: 60%;"> -->
										<h5>Kids Birthday Cakes</h5>
										<a class="dropdown-item" href="cake-designs.php?design_id=1">All Birthday Cakes</a>
										<a class="dropdown-item" href="cake-designs.php?design_id=8">Girls Birthday Cakes</a>
										<a class="dropdown-item" href="cake-designs.php?design_id=9">Boys Birthday Cakes</a>
										<a class="dropdown-item" href="cake-designs.php?design_id=10">Twins Birthday Cakes</a>
									</div>
									<div class="col-sm-6 col-lg-3">
										<!-- <img src="img/gallery/Hatchimals Cake/5.jpg" alt="..." style="width: 60%;"> -->
										<h5>Adult Birthday Cakes</h5>
										<a class="dropdown-item" href="cake-designs.php?design_id=2">All Birthday Cakes</a>
										<a class="dropdown-item" href="cake-designs.php?design_id=12">Female Birthday Cakes</a>
										<a class="dropdown-item" href="cake-designs.php?design_id=13">Male Birthday Cakes</a>
										<a class="dropdown-item" href="cake-designs.php?design_id=14">Twins Birthday Cakes</a>
									</div>
									<div class="col-sm-6 col-lg-3">
										<h5>Other Cakes</h5>
										<a class="dropdown-item" href="cake-designs.php?design_id=3">Cupcakes & Mini Cakes</a>
										<a class="dropdown-item" href="cake-designs.php?design_id=4">Wedding Cakes</a>
										<a class="dropdown-item" href="cake-designs.php?design_id=5">Christening Cakes</a>
										<a class="dropdown-item" href="cake-designs.php?design_id=6">Naming & Baby Shower Cakes</a>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'cake-flavours.php' ? 'active' : '');?>">
							<a href="cake-flavours.php">Cake Flavours</a>
						</li>
						<li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'cake-fillings.php' ? 'active' : '');?>">
							<a href="cake-fillings.php">Cake Fillings</a>
						</li>
						<li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'cake-sizes.php' ? 'active' : '');?>">
							<a href="cake-sizes.php">Cake Sizes</a>
						</li>
						<li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'get-a-quote.php' ? 'active' : '');?>">
							<a href="get-a-quote.php">Get a Quote</a>
						</li>
						<li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '');?>">
							<a href="about.php">About Us</a>
						</li>
						<li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : '');?>">
							<a href="contact.php">Contact Us</a>
						</li>

						<!-- <li class="nav-item dropdown megamenu-li">
							<a class="nav-link dropdown-toggle" href="" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mega Menu 2</a>
							<div class="dropdown-menu megamenu" aria-labelledby="dropdown02">
								<div class="row">
								<div class="col-sm-6 col-lg-4">
								<h5>Image Slider</h5>
								<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<div class="carousel-item active">
									<img class="d-block w-100" src="https://source.unsplash.com/250x150/?sig=1" alt="...">
									</div>
									<div class="carousel-item">
									<img class="d-block w-100" src="https://source.unsplash.com/250x150/?sig=2" alt="...">
									</div>
									<div class="carousel-item">
									<img class="d-block w-100" src="https://source.unsplash.com/250x150/?sig=3" alt="...">
									</div>
								</div>
								</div>
								</div>
								<div class="col-sm-6 col-lg-3">
								<h5>Links</h5>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
								</div>
								<div class="col-sm-6 col-lg-5">
								<h5>Paragraph</h5>
								<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam impedit itaque minus distinctio possimus reiciendis et repellat. Voluptate, temporibus veniam et praesentium alias, maxime repudiandae aliquid, natus omnis animi iste!</p>
								</div>
								</div>
							</div>
						</li> -->
						
					</ul>
				</div>
			</nav>
		
			<!-- Navigation -->
			<!-- <nav class="navbar navbar-light navbar-expand-lg mainmenu justify-content-center">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mx-auto text-center">
						<li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Designs <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<!-- KIDS--
								<li class="dropdown">
									<a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kids Birthday Cakes</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
										<li><a href="cake-designs.php?design_id=1">All Birthday Cakes</a></li>
										<li><a href="cake-designs.php?design_id=8">Girls Birthday Cakes</a></li>
										<li><a href="cake-designs.php?design_id=9">Boys Birthday Cakes</a></li>
										<li><a href="cake-designs.php?design_id=10">Twins Birthday Cakes</a></li>
									</ul>
								</li>
								<!-- ADULTS--
								<li class="dropdown">
									<a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Adults Birthday Cakes</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
										<li><a href="all-adults-cakes.php">All Birthday Cakes</a></li>
										<li><a href="adults-cakes-female.php">Female Birthday Cakes</a></li>
										<li><a href="adults-cakes-male.php">Male Birthday Cakes</a></li>
										<li><a href="adults-cakes-twins.php">Twins Birthday Cakes</a></li>
									</ul>
								</li>
								<li><a href="#">Cupcakes & Mini Cakes</a></li>
								<li><a href="wedding-cakes.php">Wedding Cakes</a></li>
								<li><a href="#">Christening Cakes</a></li>
								<li><a href="#">Naming & Baby Shower Cakes</a></li>
							</ul>
						</li>
						<li><a href="cake-flavours.php">Cake Flavours</a></li>
						<li><a href="cake-fillings.php">Cake Fillings</a></li>
						<li><a href="cake-sizes.php">Cake Sizes</a></li>
						<li><a href="get-a-quote.php">Get a Quote</a></li>
						<li><a href="about.php">About Us</a></li>
						<li><a href="contact.php">Contact Us</a></li>
					</ul>
				</div>
			</nav> -->

		</div>	
		
	</div>