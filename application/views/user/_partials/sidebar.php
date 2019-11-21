<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DomPAY</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if($title == 'Dashboard') echo "active"; ?>">
        <a class="nav-link" href="<?= base_url('user'); ?>">
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
        <a class="nav-link" href="<?= base_url('user/bank'); ?>">
            <i class="fas fa-fw fa-university"></i>
            <span>Bank</span>
        </a>
    </li>

    <!-- Nav Item - Collapse Menu -->
    <li class="nav-item  <?php if($title == 'Mutasi') echo "active"; ?>">
        <a class="nav-link" href="<?= base_url('user/mutasi'); ?>">
            <i class="fas fa-fw fa-sync-alt"></i>
            <span>Mutasi</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->