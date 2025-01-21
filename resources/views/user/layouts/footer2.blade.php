<div class="footer-nav-area" id="footerNav">
    <div class="container px-0">
        <!-- Footer Content -->
        <div class="footer-nav position-relative shadow-sm footer-style-two">
        <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
            <li class="">
            <a href="/" data-bs-toggle="offcanvas" data-bs-target="#affanOffcanvas" aria-controls="affanOffcanvas">
                <i class="fa fa-bars fa-2x"></i>
                <span>Menu</span>
            </a>
            </li>
            <li class="">
                <a href="{{route('bills.index')}}">
                    <i class="fa fa-cart-plus fa-2x"></i>
                    <span>Services</span>
                </a>
            </li>
            <li class="active">
                <a href="{{route('user.dashboard')}}">
                    <i class="fab fa-hive fa-2x"></i>
                </a>
            </li>
            <li class="">
                <a href="{{route('user.transactions')}}">
                    <i class="fas fa-newspaper fa-2x"></i>
                    <span>History</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('user.setting')}}">
                    <i class="fa fa-user-cog fa-2x"></i>
                    <span>Settings</span>
                </a>
            </li>
        </ul>
        </div>
    </div>
</div>