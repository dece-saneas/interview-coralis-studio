<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="<?= base_url() ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/css/sweetalert.min.css">
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
							<h4 class="card-title">Login</h4>
                            <?php $alert = session('alert'); ?>
							<form method="POST" class="my-login-validation" novalidate="" action="<?= base_url(); ?>/login">
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
								</div>

								<div class="form-group">
									<label for="password">Password
										<a href="<?= base_url('password/reset'); ?>" class="float-right">
											Forgot Password?
										</a>
									</label>
									<input id="password" type="password" class="form-control <?php if(isset($alert['password'])){ ?> is-invalid <?php } ?>" name="password" required data-eye>
                                    <?php if(isset($alert['password'])){ ?>
									<div class="invalid-feedback">
										<?= $alert['password']; ?>
									</div>
                                    <?php }; ?>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Remember Me</label>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">Login</button>
								</div>
								<div class="mt-4 text-center">
									Don't have an account? <a href="<?= base_url('register'); ?>">Create One</a>
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
	<script src="<?= base_url() ?>/js/sweetalert.min.js"></script>
	<script src="<?= base_url() ?>/js/script.js"></script>
    <!-- Alert -->
    <?php $toast = ['success', 'error'] ?>
    <?php foreach ($toast as $type)
    if(session($type)){ ?>
    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
            });

            Toast.fire({
                icon: '<?= $type; ?>',
                title: '<?= session($type); ?>',
            });
        });
    </script>
    <?php session()->remove($type); }; ?>
</body>
</html>
