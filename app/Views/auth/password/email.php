<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Reset Password</title>
	<link rel="stylesheet" href="<?= base_url() ?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>/css/style.css">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/img/logo.png"/>
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center align-items-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="<?= base_url() ?>/img/logo.png" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Forgot Password</h4>
                            <?php $alert = session('alert'); ?>
							<form method="POST" class="my-login-validation" novalidate="" action="<?= base_url(); ?>/password/reset">
                            <?= csrf_field(); ?>
								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control <?php if(isset($alert['email']) || isset($alert['invalid'])){ ?> is-invalid <?php }; ?>" name="email" value="" required autofocus>
                                    <?php if(isset($alert['email'])){ ?>
									<div class="invalid-feedback">
										<?= $alert['email']; ?>
									</div>
                                    <?php }elseif(isset($alert['invalid'])){ ?>
									<div class="invalid-feedback">
										<?= $alert['invalid']; ?>
									</div>
                                    <?php }; ?>
									<div class="form-text text-muted">
										By clicking "Reset Password" we will send a password reset link
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">Login</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2017 &mdash; Dece Saneas
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="<?= base_url() ?>/js/jquery-3.5.1.min.js"></script>
	<script src="<?= base_url() ?>/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>/js/script.js"></script>
</body>
</html>
