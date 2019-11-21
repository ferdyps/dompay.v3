<?php $this->load->view('user/_partials/header');?>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php $this->load->view('user/_partials/sidebar');?>
        <?php $this->load->view('user/_partials/navbar');?>
        <?php $this->load->view($content);?>
        <?php $this->load->view('user/_partials/footbar');?>
    </div>
    <?php $this->load->view('user/_partials/scroll');?>
    <?php $this->load->view('user/_partials/modal');?>
    <?php $this->load->view('user/_partials/account_bank_modal');?>
<?php $this->load->view('user/_partials/footer');?>