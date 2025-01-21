<div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1" aria-labelledby="affanOffcanvsLabel">
    <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    <div class="offcanvas-body p-0">
      <!-- Side Nav Wrapper -->
      <div class="sidenav-wrapper">
        <!-- Sidenav Profile -->
        <div class="sidenav-profile bg-gradient">
          <div class="sidenav-style1"></div>
          <!-- User Info -->
          <div class="user-info">
            <h4 class="user-name mb-0">{{Auth::user()->username}}</h4>
            <span>Balance: {{format_price(Auth::user()->balance)}}</span> <br>
            <span>Bonus: {{format_price(Auth::user()->bonus)}}</span>
          </div>
        </div>
        <!-- Sidenav Nav -->
        <ul class="sidenav-nav ps-0">
          <li><a href="{{route('user.dashboard')}}"><i class="bi bi-house-door"></i>Dashboard</a></li>
          <li><a href="{{route('bills.index')}}"><i class="bi bi-collection"></i>All Bills</a></li>
          <li><a href="{{route('user.wallet')}}"><i class="bi bi-cart-check"></i>Wallet</a></li>
          <li><a href="{{route('user.accounts')}}"><i class="bi bi-bank"></i>Bank Accounts</a></li>
          <li><a href="#"><i class="fa fa-money-bill"></i>Reports</a>
            <ul>
              @if(sys_setting('is_airtime') == 1)
              <li><a href="{{route('user.airtime.logs')}}">Airtime Logs</a></li>
              @endif
              @if(sys_setting('is_data') == 1)
              <li><a href="{{route('user.data.logs')}}">Data Logs</a></li>
              @endif
              @if(sys_setting('is_cable') == 1)
              <li><a href="{{route('user.cable.logs')}}">Cable TV</a></li>
              @endif
              @if(sys_setting('airtime_cash') == 1)
              <li><a href="{{route('user.swap.logs')}}">Airtime Swap</a></li>
              @endif
              @if(sys_setting('is_electricity') == 1)
              <li><a href="{{route('user.power.logs')}}">Electricity Logs</a></li>
              @endif
              @if(sys_setting('airtime_pin') == 1)
              <li><a href="{{route('user.vouchers.logs')}}">Recharge Pins</a></li>
              @endif
              @if(sys_setting('is_education') == 1)
              <li><a href="{{route('user.education.logs')}}">Education Logs</a></li>
              @endif
              @if(sys_setting('is_bulksms') == 1)
              <li><a href="{{route('user.sms.logs')}}">Bulk SMS</a></li>
              @endif
            </ul>
          </li>
          <li><a href="{{route('user.referral')}}"><i class="fa fa-users"></i>Referral</a></li>
          {{-- <li><a href="{{route('developer.index')}}"><i class="bi bi-code"></i>Developer API</a></li> --}}
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
        </ul>
      </div>
    </div>
</div>