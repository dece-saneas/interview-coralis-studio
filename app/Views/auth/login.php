<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
</head>
<body>
	<?php $session = session(); $error = session()->getFlashdata('error'); ?>
    <form method="post" action="<?= base_url(); ?>/login">
    <?= csrf_field(); ?>
        <input type="email" id="email" name="email" placeholder="Email">
		<?php if(isset($error['email'])){ echo $error['email']; } ?>
		<?php if(isset($error['invalid'])){ echo $error['invalid']; } ?><br>
        <input type="password" id="password" name="password" placeholder="Password">
		<?php if(isset($error['password'])){ echo $error['password']; } ?><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>