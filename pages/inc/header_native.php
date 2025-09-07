<div class="page-content">
    <div class="page-header">
        <nav class="navbar navbar-expand-lg d-flex justify-content-between">
            <div class="header-title flex-fill">
                <a href="#" id="sidebar-toggle"><i data-feather="arrow-left"></i></a>
                <h5 style="font-family: Poppins;"><?php echo $page_title ?></h5>
            </div>
            <div class="flex-fill" id="headerNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link profile-dropdown text-sm-end" href="#" id="profileDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= Image($k_image); ?>" style="border-radius: 50%;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-drop-menu" aria-labelledby="profileDropDown">
                            <a class="dropdown-item" href="/myaccount"><i data-feather="user"></i>Hesabım</a>
                            <hr style="background-color: #30363d;opacity: 1;">
                            <a class="dropdown-item" href="/logout"><i data-feather="log-out"></i>Çıkış Yap</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>