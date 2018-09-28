<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li @click="menu = 0" class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="icon-speedometer"></i>
                    Desktop
                </a>
            </li>
            <li class="nav-title">
                Maintenance
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="icon-bag"></i>
                    Storage
                </a>
                <ul class="nav-dropdown-items">
                    <li @click="menu = 1" class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="icon-bag"></i>
                            Categories
                        </a>
                    </li>
                    <li @click="menu = 2" class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="icon-bag"></i>
                            Articles
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="icon-wallet"></i>
                    Purchases
                </a>
                <ul class="nav-dropdown-items">
                    <li @click="menu = 3" class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="icon-wallet"></i>
                            Incomes
                        </a>
                    </li>
                    <li @click="menu = 4" class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="icon-notebook"></i>
                            Providers
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="icon-basket"></i>
                    Sales
                </a>
                <ul class="nav-dropdown-items">
                    <li @click="menu = 5" class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="icon-basket-loaded"></i>
                            Sales
                        </a>
                    </li>
                    <li @click="menu = 6" class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="icon-notebook"></i>
                            Clients
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="icon-people"></i>
                    Access
                </a>
                <ul class="nav-dropdown-items">
                    <li @click="menu = 7" class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="icon-user"></i>
                            Users
                        </a>
                    </li>
                    <li @click="menu = 8" class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="icon-user-following"></i>
                            Roles
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="icon-pie-chart"></i>
                    Reports
                </a>
                <ul @click="menu = 9" class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="icon-chart"></i>
                            Income Reports
                        </a>
                    </li>
                    <li @click="menu = 10" class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="icon-chart"></i>
                            Sales Reports
                        </a>
                    </li>
                </ul>
            </li>
            <li @click="menu = 11" class="nav-item">
                <a class="nav-link" href="#">
                    <i class="icon-book-open"></i>
                    Help
                    <span class="badge badge-danger">
                        PDF
                    </span>
                </a>
            </li>
            <li @click="menu = 12" class="nav-item">
                <a class="nav-link" href="#">
                    <i class="icon-info"></i>
                    About...
                    <span class="badge badge-info">
                        Bcryp7
                    </span>
                </a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>