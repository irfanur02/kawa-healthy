<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="../logo.ico">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href=<?php echo base_url("/assets/css/bootstrap.min.css"); ?>>
  <link rel="stylesheet" href=<?php echo base_url("/assets/icons-main/font/bootstrap-icons.min.css"); ?>>
  <link rel="stylesheet" href=<?php echo base_url("/assets/_admin/style.css"); ?>>
</head>

<body>

  <?php echo $this->renderSection('content'); ?>

  <script src=<?php echo base_url("/assets/js/bootstrap.bundle.min.js"); ?>></script>
  <script src=<?php echo base_url("/assets/js/bootstrap.min.js"); ?>></script>
  <script src=<?php echo base_url("/assets/js/popper.min.js"); ?>></script>
  <script src=<?php echo base_url("/assets/js/jquery-3.7.1.min.js"); ?>></script>
  <script src=<?php echo base_url("/assets/_admin/script.js"); ?>></script>
</body>

</html>