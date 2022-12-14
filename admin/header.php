<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Flex Media - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <?php if ($_SESSION["type"] === "admin"): ?>
              <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin_index.php">
                  <!--<div class="sidebar-brand-icon rotate-n-15">
                      <i class="fas fa-laugh-wink"></i>
                  </div>-->
                  <div class="sidebar-brand-text mx-3">Flex Media </div>
              </a>
            <?php else: ?>
              <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                  <!--<div class="sidebar-brand-icon rotate-n-15">
                      <i class="fas fa-laugh-wink"></i>
                  </div>-->
                  <div class="sidebar-brand-text mx-3">Flex Media </div>
              </a>
            <?php endif; ?>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
              <?php if ($_SESSION["type"] === "admin"): ?>
                <a class="nav-link" href="admin_index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
              <?php else: ?>
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
              <?php endif; ?>


            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Articles</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Articles:</h6>

                        <a class="collapse-item" href="add_article.php">Add article</a>
                        <?php
                        if ($_SESSION["type"] === "admin") {
                          echo "<a class='collapse-item' href='admin_articles.php'>Articles</a>";
                        }else {
                          echo "<a class='collapse-item' href='articles.php'>Articles</a>";
                        }
                         ?>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->

            <?php if ($_SESSION["type"] === "admin"): ?>
              <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                      aria-expanded="true" aria-controls="collapseUtilities">
                      <i class="fas fa-fw fa-wrench"></i>
                      <span>Donations</span>
                  </a>
                  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                      data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                          <h6 class="collapse-header">Transactions:</h6>
                          <a class="collapse-item" href="deposit.php">Donations</a>

                      </div>
                  </div>
              </li>

              <!-- Divider -->
              <hr class="sidebar-divider">

              <!-- Heading -->
              <div class="sidebar-heading">
                  Users
              </div>

              <!-- Nav Item - Pages Collapse Menu -->
              <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                      aria-expanded="true" aria-controls="collapsePages">
                      <i class="fas fa-fw fa-folder"></i>
                      <span>Users</span>
                  </a>
                  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                      <div class="bg-white py-2 collapse-inner rounded">
                          <h6 class="collapse-header">Admins:</h6>
                          <a class="collapse-item" href="admins.php">Admins</a>
                          <div class="collapse-divider"></div>
                          <h6 class="collapse-header">Authors:</h6>
                          <a class="collapse-item" href="authors.php">Authors</a>
                      </div>
                  </div>
              </li>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->

                        <!-- Nav Item - Messages -->

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="btn btn-dark" href="includes/logout.inc.php">Logout </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
