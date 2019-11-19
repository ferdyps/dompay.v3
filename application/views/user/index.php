<div class="wrapper">
    <?php $this->load->view('user/_partials/header');?>
    <?php $this->load->view('user/_partials/sidebar');?>
    <?php $this->load->view('user/_partials/navbar');?>
    <?php $this->load->view($content);?>
    <?php $this->load->view('user/_partials/footbar');?>
    <?php $this->load->view('user/_partials/scroll');?>
    <?php $this->load->view('user/_partials/modal');?>
    <?php $this->load->view('user/_partials/footer');?>
</div>