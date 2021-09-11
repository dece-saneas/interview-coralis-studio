<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reset Password</title>
</head>
<body>
    <a href="<?= base_url() ?>/password/reset/<?= $email ?>?token=<?= urlencode($token) ?>">Reset Password</a>
</body>
</html>