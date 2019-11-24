<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('employee'); ?>">
        <div class="sidebar-brand-icon">
            <!-- <i class="fas fa-money-bill-wave"></i> -->
            <img src="<?= base_url('assets/images/login.png')?>" width="100%"><img>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if($title == 'Dashboard') echo "active"; ?>">
        <a class="nav-link" href="<?= base_url('employee'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
    Data
    </div>

    <!-- Nav Item - Collapse Menu -->
    <li class="nav-item  <?php if($title == 'Bank') echo "active"; ?>">
        <a class="nav-link" href="<?= base_url('employee/bank'); ?>">
            <i class="fas fa-fw fa-university"></i>
            <span>Bank</span>
        </a>
    </li>

    <!-- Nav Item - Collapse Menu -->
    <?php if(in_array('Debit', $this->fitur) || in_array('Kredit', $this->fitur)) { ?>
    <li class="nav-item  <?php if($title == 'Mutasi') echo "active"; ?>">
        <a class="nav-link" href="<?= base_url('employee/mutasi'); ?>">
            <i class="fas fa-fw fa-sync-alt"></i>
            <span>Mutasi</span>
        </a>
    </li>
    <?php } ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->