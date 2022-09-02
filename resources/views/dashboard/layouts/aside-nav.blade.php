<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li class="sidebar-item pt-2">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('dashboard') }}"
                        aria-expanded="false">
                        <i class="far fa-clock" aria-hidden="true"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item ">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('JenisHewan.index') }}"
                        aria-expanded="false">
                        <i class="fas fa-stream"></i>
                        <span class="hide-menu">Jenis Hewan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('RasHewan.index') }}"
                        aria-expanded="false">
                        <i class="fas fa-cart-plus"></i>
                        <span class="hide-menu">Ras Hewan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('PostAdopsi.index') }}"
                        aria-expanded="false">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span class="hide-menu">Post Adopsi</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="route('logout')"
                        onclick="event.preventDefault();
                                this.closest('form').submit();"
                        aria-expanded="false">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        <span class="hide-menu">Logout</span>
                    </a>
                    </form>
                </li>




            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
