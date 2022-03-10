<aside id="sidebar-left" class="sidebar-left" >

<div class="sidebar-header">
    <div class="sidebar-toggle d-none d-md-flex" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
        <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
    </div>
</div>

<div class="nano">
    <div class="nano-content">
        <nav id="menu" class="nav-main" role="navigation">

            <ul class="nav nav-main">
                <li>
                    <a class="nav-link" href="{{route('viewProducts')}}">
                    <i class="fa fa-cubes" aria-hidden="true"></i>
                        <span>Products</span>
                    </a>                        
                </li>
            </ul>
            <ul class="nav nav-main">
                <li>
                    <a class="nav-link" href="{{route('plans')}}">
                    <i class="fa-solid fa-box-open"></i>
                        <span>Plans</span>
                    </a>                        
                </li>
            </ul>
            <ul class="nav nav-main">
                <li>
                    <a class="nav-link" href="{{url('/subscription-test/ahsan-fabrics99.myshopify.com')}}">
                    <i class="fa-solid fa-box-open"></i>
                        <span>PackageTesting</span>
                    </a>                        
                </li>
            </ul>
        </nav>

    </div>

    <script>
        // Maintain Scroll Position
        if (typeof localStorage !== 'undefined') {
            if (localStorage.getItem('sidebar-left-position') !== null) {
                var initialPosition = localStorage.getItem('sidebar-left-position'),
                    sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                sidebarLeft.scrollTop = initialPosition;
            }
        }
    </script>

</div>

</aside>