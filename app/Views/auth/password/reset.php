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
							<h4 class="card-title">Reset Password</h4>
                            <?php $alert = session('alert'); ?>
							<form method="POST" class="my-login-validation" novalidate="" action="<?= base_url(); ?>/password/reset/<?= session('email'); ?>?token=<?= urlencode(session('token')); ?>">
                            <?= csrf_field(); ?>
								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control <?php if(isset($alert['password']) || isset($alert['password_confirm'])){ ?> is-invalid <?php }; ?>" name="password" required data-eye>
                                    <?php if(isset($alert['password'])){ ?>
									<div class="invalid-feedback">
										<?= $alert['password']; ?>
									</div>
                                    <?php }elseif(isset($alert['password_confirm'])){ ?>
									<div class="invalid-feedback">
										<?= $alert['password_confirm']; ?>
									</div>
                                    <?php }; ?>
								</div>
								<div class="form-group">
									<label for="password_confirm">ConfirmPassword</label>
									<input id="password_confirm" type="password" class="form-control" name="password_confirm" required data-eye>
									<div class="form-text text-muted">
										Make sure your password is strong and easy to remember
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">Reset Password</button>
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
