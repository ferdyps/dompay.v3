<?php $this->load->view('employees/_partials/header');?>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php $this->load->view('employees/_partials/sidebar');?>
        <?php $this->load->view('employees/_partials/navbar');?>
        <?php $this->load->view($content);?>
        <?php $this->load->view('employees/_partials/footbar');?>
    </div>
    <?php $this->load->view('employees/_partials/scroll');?>
    <?php $this->load->view('employees/_partials/modal');?>
    <?php $this->load->view('employees/_partials/account_bank_modal');?>
    <?php $this->load->view('employees/_partials/js');?>
<?php $this->load->view('employees/_partials/footer');?>