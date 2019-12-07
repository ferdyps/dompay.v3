<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('owner'); ?>">
        <div class="sidebar-brand-icon">
            <!-- <i class="fas fa-money-bill-wave"></i> -->
            <img src="<?= base_url('assets/images/logo/logo-master-w.png')?>" width="100%">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if($title == 'Dashboard') echo "active"; ?>">
        <a class="nav-link" href="<?= base_url('owner'); ?>">
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
        <a class="nav-link" href="<?= base_url('owner/bank'); ?>">
            <i class="fas fa-fw fa-university"></i>
            <span>Bank</span>
        </a>
    </li>

    <!-- Nav Item - Collapse Menu -->
    <li class="nav-item  <?php if($title == 'Mutasi') echo "active"; ?>">
        <a class="nav-link" href="<?= base_url('owner/mutasi'); ?>">
            <i class="fas fa-fw fa-sync-alt"></i>
            <span>Mutasi</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
    Setting
    </div>

    <!-- Nav Item - Collapse Menu -->
    <li class="nav-item <?php if($title == "Setting") echo "active"; ?>">
        <a class="nav-link" href="<?= base_url('owner/list_employee');?>">
            <i class="fas fa-fw fa-cog"></i>
            <span>Setting Akun Employee</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle" onclick="sidebar();"></button>
    </div>

</ul>
<!-- End of Sidebar -->