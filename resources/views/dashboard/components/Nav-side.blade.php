<!--/. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">

                <li>
                    <a href="#"><i class="fa fa-home"></i> Inicio</a>
                </li>
                <li>
                    <a href="{{ route('sites') }}"><i class="fa fa-building"></i> Sitios</a>
                </li>
                <li>
                    <a href="{{ URL::to('panel/requisiciones') }}"><i class="fas fa-clipboard"></i> Requisiciones</a>
                </li>
              
                <!--li>
                    <a href="#"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">Second Level Link</a>
                        </li>
                        <li>
                            <a href="#">Second Level Link</a>
                        </li>
                        <li>
                            <a href="#">Second Level Link<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="#">Third Level Link</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Link</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Link</a>
                                </li>

                            </ul>

                        </li>
                    </ul>
                </li-->
            </ul>

        </div>

    </nav>