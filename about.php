<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>About Us | Designer Cakes Toowoomba</title>

	<?php include('layout-header.php');?>
	
	<style>
	/*table {
		border-collapse: collapse;
		width: 100%;
	}
	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 2px;
	}
	th
	{
		background-color:black;
		color:white;
	}
	
	td:first-child
	{
	  background-color:grey;
	}
	
	.table-responzive {
	  max-width: 40em;
	  max-height: 20em;
	  overflow: scroll;
	  position: relative;
	}

	.table-responzive table {
	  position: relative;
	  border-collapse: collapse;
	}

	.table-responzive td, .table-responzive th {
	  padding: 0.25em;
	}

	.table-responzive thead th {
	  position: -webkit-sticky; /* for Safari */
	  position: sticky;
	  top: 0;
	  background: #000;
	  color: #FFF;
	}

	.table-responzive thead th:first-child {
	  left: -1px;
	  z-index: 1;
	}

	.table-responzive tbody th {
	  position: -webkit-sticky; /* for Safari */
	  position: sticky;
	  left: -1px;
	  background: #FFF;
	  border-right: 1px solid #CCC;
	}
	
	.table-responzive th:first-child, .table-responzive td:first-child
	{
	  position:sticky;
	  left:-1px;
	  background-color:white;	 
	}*/
	
	</style>

</head>

<body>
	<!-- Header -->
	<?php include('header.php'); ?>

	<!-- Page Header -->
	<div class="container cake-designs">
		<!-- Page Heading/Breadcrumbs -->
		<h1>About Us</h1>
	</div>
	
	<div id="contatti">
		<div class="container mt-5" >

			<div class="row">
				<div class="col-md-12" >
					<img class="img-fluid" src="img/about-bg.jpg">  
				</div>
				<div class="col-md-12 mt-5">
					<p>Contrary to popular belief, Lorem Ipsum is not simply random text. 
					It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. 
					Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, 
					looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, 
					and going through the cites of the word in classical literature, discovered the undoubtable source. 
					Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (
					The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, 
					very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
					
					<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus 
					Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. 
					Rackham.
					</p>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Page Content
	<div class="container pt-5 contact-page">
		<div class="row mt-3">			
			<div class="col-lg-12">
		
				<div class="map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28284.860902542536!2d151.9051347231845!3d-27.605692351365562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b965b0eef2bf21d%3A0x500eef17f20f640!2sDarling+Heights+QLD+4350%2C+Australia!5e0!3m2!1sen!2slk!4v1551957446295" width="100%" height="650px" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				
				<div class="contact-form">
					<h2 class="title">We are here to assist you.</h2>
					<form action="">
						<input type="text" name="name" placeholder="Your Name" />
						<input type="email" name="e-mail" placeholder="Your E-mail Adress" />
						<input type="tel" name="phone" placeholder="Your Phone Number"/>
						<textarea name="text" id="" rows="8" placeholder="Your Message"></textarea>
						<button class="btn-send">Get a Call Back</button>
					</form>
				</div>
			</div>
		</div>
		
		<div class="row mt-3">			
			<div class="col-md-12">				
				<b>Anne:</b> <br />
				Phone: 0416 304 671<br />
				E-mail: <a href="mailto:youremail@designercakestoowoobma.com">youremail@designercakestoowoobma.com</a><br />
			</div>
		</div>
		
	</div>-->

	<?php include('footer.php'); ?>
	
	<?php include('layout-footer.php'); ?>	
	
	<script>
		$(document).ready(function() {
		  $('tbody').scroll(function(e) { //detect a scroll event on the tbody
			/*
			Setting the thead left value to the negative valule of tbody.scrollLeft will make it track the movement
			of the tbody element. Setting an elements left value to that of the tbody.scrollLeft left makes it maintain 			it's relative position at the left of the table.    
			*/
			$('thead').css("left", -$("tbody").scrollLeft()); //fix the thead relative to the body scrolling
			$('thead th:nth-child(1)').css("left", $("tbody").scrollLeft()); //fix the first cell of the header
			$('tbody td:nth-child(1)').css("left", $("tbody").scrollLeft()); //fix the first column of tdbody
		  });
		});

	</script>

</body>

</html>
