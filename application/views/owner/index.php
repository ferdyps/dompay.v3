<?php $this->load->view('owner/_partials/header');?>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php $this->load->view('owner/_partials/sidebar');?>
        <?php $this->load->view('owner/_partials/navbar');?>
        <?php $this->load->view($content);?>
        <?php //$this->load->view('owner/_partials/footbar');?>
    </div>
    <?php $this->load->view('owner/_partials/scroll');?>
    <?php $this->load->view('owner/_partials/modal');?>
    <?php $this->load->view('owner/_partials/js');?>
<?php $this->load->view('owner/_partials/footer');?>