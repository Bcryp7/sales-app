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
            <li class="nav-item">
                <a class="nav-link" href="https://github.com/Bcryp7?tab=repositories" target="_blank">
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