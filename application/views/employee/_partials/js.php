<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/vendor/SBAdmin/js/sb-admin-2.min.js')?>"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/vendor/SBAdmin/vendor/chart.js/Chart.min.js');?>"></script>
<script src="<?= base_url('assets/vendor/sweetalert2-9.3.6/dist/sweetalert2.all.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/numeral/numeral.min.js'); ?>"></script>
<script src="<?= base_url("assets/vendor/select2-4.0.12/js/select2.full.min.js"); ?>"></script>

<!-- Page level custom scripts -->
<?php if($title == "Dashboard") { ?>
    <script src="<?= base_url('assets/vendor/SBAdmin/js/demo/chart-area-demo.js');?>"></script>
    <script src="<?= base_url('assets/vendor/SBAdmin/js/demo/chart-pie-demo.js')?>"></script>
<?php } ?>

<script src="<?= base_url('assets/js/main.js'); ?>"></script>