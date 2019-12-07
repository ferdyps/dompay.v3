<?php $this->load->view('admin/_partials/header');?>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php $this->load->view('admin/_partials/sidebar');?>
        <?php $this->load->view('admin/_partials/navbar');?>
        <?php $this->load->view($content);?>
        <?php //$this->load->view('admin/_partials/footbar');?>
    </div>
    <?php $this->load->view('admin/_partials/scroll');?>
    <?php $this->load->view('admin/_partials/modal');?>
    <?php $this->load->view('admin/_partials/js');?>
<?php $this->load->view('admin/_partials/footer');?>