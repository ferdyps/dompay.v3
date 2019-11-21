<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= config_item('web_title'); ?></title>
        <link rel="shortcut icon" href="<?= base_url('assets/images/login.png');?>" type="image/x-icon">
        <link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap-4.3.1-dist/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome-free-5.7.2-web/css/all.min.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/iofrm-style.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/iofrm-theme9.css'); ?>">
        <?php $this->load->view('auth/_partials/js_core');?>
    </head>
    <body>