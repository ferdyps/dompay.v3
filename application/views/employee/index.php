<?php $this->load->view('employee/_partials/header');?>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php $this->load->view('employee/_partials/sidebar');?>
        <?php $this->load->view('employee/_partials/navbar');?>
        <?php $this->load->view($content);?>
        <?php //$this->load->view('employee/_partials/footbar');?>
    </div>
    <?php $this->load->view('employee/_partials/scroll');?>
    <?php $this->load->view('employee/_partials/modal');?>
    <?php $this->load->view('employee/_partials/js');?>
<?php $this->load->view('employee/_partials/footer');?>