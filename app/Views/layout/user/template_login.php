<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="../logo.ico">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/icons-main/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="/assets/_user/style.css">
</head>

<body class="fw-medium">

  <?php echo $this->renderSection('content'); ?>

  <script src="/assets/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/popper.min.js"></script>
  <script src="/assets/js/jquery-3.7.1.min.js"></script>
  <script src="/assets/_user/script.js"></script>
</body>

</html>