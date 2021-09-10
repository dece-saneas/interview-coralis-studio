<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>
</head>
<body>
    <form method="post" action="<?= base_url(); ?>/register" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <?php $error = session('error'); ?>
		<input type="file" id="photo" name="photo">
		<?php if(isset($error['photo'])){ echo $error['photo']; } ?><br>
        <input type="text" id="name" name="name" placeholder="Nama Lengkap">
		<?php if(isset($error['name'])){ echo $error['name']; } ?><br>
        <input type="email" id="email" name="email" placeholder="Email">
		<?php if(isset($error['email'])) echo $error['email']; ?><br>
        <input type="password" id="password" name="password" placeholder="Password">
		<?php if(isset($error['password'])){ echo $error['password']; } ?>
		<?php if(isset($error['password_confirm'])){ echo $error['password_confirm']; } ?><br>
        <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirm Password"><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>