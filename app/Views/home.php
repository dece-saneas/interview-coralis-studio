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
					<div class="card fat">
						<div class="card-body">
							<img src="<?= base_url(); ?>/img/photo/<?= session('auth')['user']->photo; ?>" alt="Photo" class="img-fluid">
						</div>
						<div class="card-body text-center">
							<h2><?= session('auth')['user']->name; ?></h2>
                            <h6 class="text-muted mb-4"><?= session('auth')['user']->email; ?></h6>
                            <a href="<?= base_url('logout') ?>" class="btn btn-sm btn-primary">Logout</a>
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
