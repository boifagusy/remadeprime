<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{get_setting('description')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="robots" content="index, follow">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>@yield('title') - {{get_setting('title')}}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{my_asset(get_setting('favicon'))}}">
    <link rel="apple-touch-icon" href="{{my_asset(get_setting('touch_icon'))}}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{static_asset('css/vendors.css')}}">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{static_asset('css/style.css')}}">
    <link rel="stylesheet" href="{{static_asset('css/snackbar.min.css')}}">
    @yield('styles')
  </head>
  <body>
    <!-- Dark mode switching -->
    <div class="dark-mode-switching">
        <div class="d-flex w-100 h-100 align-items-center justify-content-center">
          <div class="dark-mode-text text-center">
            <svg class="bi bi-moon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M14.53 10.53a7 7 0 0 1-9.058-9.058A7.003 7.003 0 0 0 8 15a7.002 7.002 0 0 0 6.53-4.47z"></path>
            </svg>
            <p class="mb-0">Switching to dark mode</p>
          </div>
          <div class="light-mode-text text-center">
            <svg class="bi bi-brightness-high" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
            </svg>
            <p class="mb-0">Switching to light mode</p>
          </div>
        </div>
    </div>    
    <!-- Header Area -->
    <div class="header-area" id="headerArea">
        <div class="container">
          <!-- Header Content -->
          <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
            <div class="back-button">
                <a href="javascript:history.back()">
                    <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
                    </svg>
                </a>
            </div>
            <div class="page-heading">
                <h6 class="mb-0">@yield('title')</h6>
            </div>
            <div class="setting-wrapper">
                {{-- <div class="setting-trigger-btn" id="settingTriggerBtn" onclick="openLink('{{route('user.transactions')}}')">
                    <i class="far fa-bell"></i><span></span>
                </div> --}}
            </div>
          </div>
          <!-- # Header Five Layout End -->
        </div>
    </div>
    {{-- content --}}
    <div class="page-content-wrapper py-3">
        <div class="custom-container">
            <div class="card">
             @yield('content')
            </div>
        </div>    
    </div>
    <!-- All JavaScript Files -->
    <script src="{{static_asset('js/vendors.js')}}"></script>
    <script src="{{static_asset('js/active.js')}}"></script>
    <script src="{{static_asset('js/snackbar.min.js')}}"></script>
    @yield('scripts')
    <script type="text/javascript">     
      @if(Session::get('success'))
      Snackbar.show({
        text: '{{Session::get('success')}}',
        pos: 'top-right',
        backgroundColor: '#38c172'
      });
      @endif
      @if(count($errors) > 0)
      Snackbar.show({
        @foreach($errors->all() as $error)
        text: '{{$error}}',
		    @endforeach
        pos: 'top-right',
        backgroundColor: '#e3342f'
      });
      @endif
      @if(Session::get('error'))
      Snackbar.show({
        text: '{{Session::get('error')}}',
        pos: 'top-right',
        backgroundColor: '#e3342f'
      });
      @endif
  </script>
  </body>
</html>