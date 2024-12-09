<?php
	include './header.php';
?>

<body>
	<div class="wrapper">
        <?php
			include './includes/sidebar.php';
		?>

		<div class="main">
			
            <?php
				include './includes/navbar.php';
			?>
            
			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Site Settings</h1>

					<div class="row">
						<div class="col-12 col-xl-6">
							<div class="card">
								<!-- <div class="card-header">
									<h5 class="card-title">Basic form</h5>
									<h6 class="card-subtitle text-muted">Default Bootstrap form layout.</h6>
								</div> -->
								<div class="card-body">
									<?php
                                        echo $settings->updateForm();
                                    ?>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

		</div>
	</div>

	<script src="js/app.js"></script>

</body>

</html>