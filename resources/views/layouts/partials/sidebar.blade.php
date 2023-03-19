<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('dashboards.index')}}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">{{ __("Dashboard") }}</span></a></li>

                            <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">{{ __("Main") }}</span></li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('orders.index')}}"
                        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                            class="hide-menu">{{ __("Sales") }}
                        </span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('purchases.index')}}"
                        aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                            class="hide-menu">{{ __("Purchases") }}</span></a></li>

                            <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">{{ __("Bases") }}</span></li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('products.index')}}"
                        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                            class="hide-menu">{{ __("Products") }}
                        </span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('customers.index')}}"
                        aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span
                            class="hide-menu">{{ __("Customers") }}</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('users.index')}}"
                        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                            class="hide-menu">{{ __("Users") }}
                        </span></a>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
