<div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1" aria-labelledby="affanOffcanvsLabel">
    <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    <div class="offcanvas-body p-0">
      <!-- Side Nav Wrapper -->
      <div class="sidenav-wrapper">
        <ul class="sidenav-nav ps-0">
          @auth
          <li><a href="{{route('user.dashboard')}}"><i class="bi bi-house-door"></i>Dashboard</a></li>
          <li><a href="{{route('bills.index')}}"><i class="bi bi-collection"></i>All Bills</a></li>
          <li><a href="{{route('user.wallet')}}"><i class="bi bi-cart-check"></i>Wallet</a></li>
          <li><a href="{{route('user.accounts')}}"><i class="bi bi-bank"></i>Bank Accounts</a></li>
          <li><a href="{{route('policy')}}"><i class="bi bi-collection"></i>Policy</a></li>
          <li><a href="{{route('contact')}}"><i class="bi bi-collection"></i>Contact</a></li>
          <li>
            <div class="night-mode-nav">
              <i class="bi bi-moon"></i>Night Mode
              <label class="jdv-switch2 jdv-switch-success ms-auto">
                <input type="checkbox" id="darkSwitch">
                <span class="slider round"></span>
              </label>
            </div>
          </li>
          <li><a href="{{route('logout')}}"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
          @else
          <li><a href="{{route('index')}}"><i class="bi bi-house-door"></i>Home</a></li>
          <li><a href="{{route('bills.index')}}"><i class="bi bi-collection"></i>All Bills</a></li>
          <li><a href="{{route('contact')}}"><i class="bi bi-collection"></i>Contact</a></li>
          <li><a href="{{route('terms')}}"><i class="bi bi-collection"></i>Terms & Conditions</a></li>
          <li><a href="{{route('policy')}}"><i class="bi bi-collection"></i>Policy</a></li>
          <li><a href="{{route('contact')}}"><i class="bi bi-collection"></i>Contact</a></li>
          <li>
            <div class="night-mode-nav">
              <i class="bi bi-moon"></i>Night Mode
              <label class="jdv-switch2 jdv-switch-success ms-auto">
                <input type="checkbox" id="darkSwitch">
                <span class="slider round"></span>
              </label>
            </div>
          </li>
          <li><a href="{{route('register')}}"><i class="bi bi-box-arrow-right"></i>Register</a></li>
          <li><a href="{{route('login')}}"><i class="bi bi-box-arrow-right"></i>Login</a></li>
          @endauth
        </ul>
      </div>
    </div>
</div>