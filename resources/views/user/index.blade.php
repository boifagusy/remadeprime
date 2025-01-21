@extends('user.layouts.masternew')
@section('title', 'Dashoard')

@section('content')
</head>
<!-- preloader.php -->
<body cz-shortcut-listen=true><div id=preloader class=preloader style=display:none>
 
</div>
<style class=sf-hidden>.preloader{position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(255,255,255,0.7);justify-content:center;align-items:center;z-index:9999}</style>
<style class=sf-hidden>.announcement-container{display:flex;align-items:center;background-color:white;padding:5px 0;border-radius:10px;color:green;position:relative;overflow:hidden;width:100%;box-shadow:0-2px 10px rgba(0,0,0,0.1)}.announcement-icon{margin-left:10px;margin-right:10px;font-size:24px;color:#22c55e}.marquee{flex:1;white-space:nowrap;overflow:hidden;position:relative}.marquee-content{display:inline-block;padding-left:100%;animation:scroll 15s linear infinite}.left1{left:16px;position:absolute;min-width:44px;height:50px;display:flex;align-items:center}@keyframes scroll{0%{transform:translateX(0%)}100%{transform:translateX(-100%)}}</style>
 <div class="header is-fixed">
 <div class=tf-container>
 <div class="tf-statusbar d-flex justify-content-center align-items-center" style=padding-top:32px;padding-bottom:30px>
 <a class=left1 href="{{route('user.dashboard')}}" >
 <img src="data:image/png;base64,/9j/4AAQSkZJRgABAQEBLAEsAAD/4QBWRXhpZgAATU0AKgAAAAgABAEaAAUAAAABAAAAPgEbAAUAAAABAAAARgEoAAMAAAABAAIAAAITAAMAAAABAAEAAAAAAAAAAAEsAAAAAQAAASwAAAAB/+0ALFBob3Rvc2hvcCAzLjAAOEJJTQQEAAAAAAAPHAFaAAMbJUccAQAAAgAEAP/hDW5odHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvADw/eHBhY2tldCBiZWdpbj0n77u/JyBpZD0nVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkJz8+Cjx4OnhtcG1ldGEgeG1sbnM6eD0nYWRvYmU6bnM6bWV0YS8nIHg6eG1wdGs9J0ltYWdlOjpFeGlmVG9vbCAxMS44OCc+CjxyZGY6UkRGIHhtbG5zOnJkZj0naHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyc+CgogPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9JycKICB4bWxuczp0aWZmPSdodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyc+CiAgPHRpZmY6UmVzb2x1dGlvblVuaXQ+MjwvdGlmZjpSZXNvbHV0aW9uVW5pdD4KICA8dGlmZjpYUmVzb2x1dGlvbj4zMDAvMTwvdGlmZjpYUmVzb2x1dGlvbj4KICA8dGlmZjpZUmVzb2x1dGlvbj4zMDAvMTwvdGlmZjpZUmVzb2x1dGlvbj4KIDwvcmRmOkRlc2NyaXB0aW9uPgoKIDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PScnCiAgeG1sbnM6eG1wPSdodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvJz4KICA8eG1wOkNyZWF0b3JUb29sPkFkb2JlIFN0b2NrIFBsYXRmb3JtPC94bXA6Q3JlYXRvclRvb2w+CiA8L3JkZjpEZXNjcmlwdGlvbj4KCiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0nJwogIHhtbG5zOnhtcE1NPSdodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vJz4KICA8eG1wTU06RG9jdW1lbnRJRD54bXAuaWlkOjVkYzhhZmYwLTdhMGUtNDlmZS05ZmE1LWFmMmI4MWQzMWEyYjwveG1wTU06RG9jdW1lbnRJRD4KICA8eG1wTU06SW5zdGFuY2VJRD5hZG9iZTpkb2NpZDpzdG9jazo0ZTkyMmRjNC03OGQ2LTQyMzItODkzMC0yNGI3YzUxMWJkOTU8L3htcE1NOkluc3RhbmNlSUQ+CiAgPHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD5hZG9iZTpkb2NpZDpzdG9jazo1NTM3OTYwOTA8L3htcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD4KIDwvcmRmOkRlc2NyaXB0aW9uPgo8L3JkZjpSREY+CjwveDp4bXBtZXRhPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAo8P3hwYWNrZXQgZW5kPSd3Jz8+/9sAQwAF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" alt=image style=width:45px>
 


 <div class=content style=padding-left:8px>
 <p class=fw_4>Welcome Back</p>
 <h4> {{ Auth()->user()->username }}  </h4>
 </div>
 </a>
 <a href=# id=btn-popup-up class=action-right>
 <svg xmlns=http://www.w3.org/2000/svg width=20 height=20 fill=#22c55e class="bi bi-bell" viewBox="0 0 16 16">
 <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"></path>
 </svg>
 </a>
 </div>
 </div>
 </div>
 
 
 <div id=app-wrap style=margin-top:8px>
 <div class=mt-5>
 <div class=tf-container>
 <div class=announcement-container>
 <i class="bi bi-megaphone announcement-icon"></i>
 <div class=marquee>
 <div class=marquee-content>
 We're thrilled to announce the launch of our new wallet app! Experience fast transactions, top-notch security, and exciting features!
 </div>
 </div>
 </div>
 <div class=tf-spacing-12></div>
 <div class=tf-balance-box style=background-color:#22c55e>
 <div class=balance>
 <div class=row>
 <div class="col-6 br-right">
 <div class=inner-left>
 <p style=color:white;font-size:15px>Your Balance:
 <i class="bi bi-eye" id=toggle-balance style=cursor:pointer></i>
 </p>
 <div class=tf-spacing-12></div>
 <div class=balance-placeholder style=display:none>
 
 </div>
 <div class=balance-wrapper>
 <h2 style=color:white>{{format_price(Auth::user()->balance)}}</h2>
 </div>
 </div>
 </div>
 <div class=col-6>
 <div class=inner-right>
 <p style=color:white>Transaction History <i class=icon-right></i></p>
 <h3>
 <a href= "{{route('user.transactions')}}" class="tf-btn accent" style=color:#22c55e;background-color:white;font-size:12px;width:50%;margin-top:8px;border-radius:40px>View All</a>
 </h3>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 
 <div class=tf-spacing-12></div>
 <div class=tf-container>
 <div class=tf-balance-box>
 <div class=wallet-footer>
 <ul class="d-flex justify-content-between align-items-center box-service mt-4">
 <li class=wallet-card-item>
 <a href=" {{route('user.wallet')}}" >
 <div class="icon-box bg_color_2">
 <svg xmlns=http://www.w3.org/2000/svg width=25 height=25 fill=#22c55e class="bi bi-wallet2" viewBox="0 0 16 16">
 <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"></path>
 </svg>
 </div>
 Add Fund
 </a>
 </li>
 <li class=wallet-card-item>
 <a href="{{route('user.dashboard')}}" class="fw_6 text-center">
 <div class="icon-box bg_color_2">
 <svg xmlns=http://www.w3.org/2000/svg width=25 height=25 fill=#22c55e class="bi bi-send" viewBox="0 0 16 16">
 <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"></path>
 </svg>
 </div>
 vinepay (soon)
 </a>
 </li>
 <li class=wallet-card-item>
 <a href= "{{route('user.dashboard')}}" >
 <div class="icon-box bg_color_2">
 <svg xmlns=http://www.w3.org/2000/svg width=25 height=25 fill=#22c55e class="bi bi-bank" viewBox="0 0 16 16">
 <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.5.5 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89zM3.777 3h8.447L8 1zM2 6v7h1V6zm2 0v7h2.5V6zm3.5 0v7h1V6zm2 0v7H12V6zM13 6v7h1V6zm2-1V4H1v1zm-.39 9H1.39l-.25 1h13.72z"></path>
 </svg>
 </div>
 Bank (soon)
 </a>
 </li>
 </ul>
 </div>
 </div>
 </div>
 </div>
 
 
 <div class=mt-5>
 <div class=tf-container>
 <div class="tf-title d-flex justify-content-between">
 <h3 class=fw_6>Quick service</h3>
 <a href="{{route('user.dashboard')}}"class="primary_color fw_6">View All</a>
 </div>


 {{-- Bills --}}
 
 <ul class="box-service mt-3">
 <li>
 @if (sys_setting('is_airtime') == 1)
 <a href= "{{route('bills.airtime')}}" >
 <div class="icon-box bg_color_2">
 <svg xmlns=http://www.w3.org/2000/svg width=25 height=25 fill=#22c55e class="bi bi-phone-vibrate" viewBox="0 0 16 16" style=stroke:#22c55e;stroke-width:0.2px>
 <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"></path>
 <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2">

 </path>
 </svg> 
 </div>
 Airtime
 </a> 
 </li>
 @endif
 
 @if (sys_setting('is_data') == 1)
 <li>
 <a href="{{route('bills.data')}}">
 <div class="icon-box bg_color_2">
 <svg xmlns=http://www.w3.org/2000/svg width=25 height=25 fill=#22c55e class="bi bi-wifi" viewBox="0 0 16 16" style=stroke:#22c55e;stroke-width:0.2px>
 <path d="M15.384 6.115a.485.485 0 0 0-.047-.736A12.44 12.44 0 0 0 8 3C5.259 3 2.723 3.882.663 5.379a.485.485 0 0 0-.048.736.52.52 0 0 0 .668.05A11.45 11.45 0 0 1 8 4c2.507 0 4.827.802 6.716 2.164.205.148.49.13.668-.049"></path>
 <path d="M13.229 8.271a.482.482 0 0 0-.063-.745A9.46 9.46 0 0 0 8 6c-1.905 0-3.68.56-5.166 1.526a.48.48 0 0 0-.063.745.525.525 0 0 0 .652.065A8.46 8.46 0 0 1 8 7a8.46 8.46 0 0 1 4.576 1.336c.206.132.48.108.653-.065m-2.183 2.183c.226-.226.185-.605-.1-.75A6.5 6.5 0 0 0 8 9c-1.06 0-2.062.254-2.946.704-.285.145-.326.524-.1.75l.015.015c.16.16.407.19.611.09A5.5 5.5 0 0 1 8 10c.868 0 1.69.201 2.42.56.203.1.45.07.61-.091zM9.06 12.44c.196-.196.198-.52-.04-.66A2 2 0 0 0 8 11.5a2 2 0 0 0-1.02.28c-.238.14-.236.464-.04.66l.706.706a.5.5 0 0 0 .707 0l.707-.707z"></path>
 </svg>
 </div>
 Data 
 </a> 
 </li>
 @endif

 
 @if (sys_setting('is_electricity') == 1)
 <li>
 <a href="{{route('bills.electricity')}}">
 <div class="icon-box bg_color_2">
 <svg xmlns=http://www.w3.org/2000/svg width=25 height=25 fill=#22c55e class="bi bi-lightning-fill" viewBox="0 0 16 16">
 <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641z"></path>
 </svg>
 
 </div>
 Electricity
 </a> 
 </li>
 @endif
 @if (sys_setting('is_cable') == 1)
 <li>
 <a href="{{route('bills.cable')}}">
 <div class="icon-box bg_color_2">
 <svg xmlns=http://www.w3.org/2000/svg width=25 height=25 fill=#22c55e class="bi bi-tv" viewBox="0 0 16 16" style=stroke:#22c55e;stroke-width:0.2px>
 <path d="M2.5 13.5A.5.5 0 0 1 3 13h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5M13.991 3l.024.001a1.5 1.5 0 0 1 .538.143.76.76 0 0 1 .302.254c.067.1.145.277.145.602v5.991l-.001.024a1.5 1.5 0 0 1-.143.538.76.76 0 0 1-.254.302c-.1.067-.277.145-.602.145H2.009l-.024-.001a1.5 1.5 0 0 1-.538-.143.76.76 0 0 1-.302-.254C1.078 10.502 1 10.325 1 10V4.009l.001-.024a1.5 1.5 0 0 1 .143-.538.76.76 0 0 1 .254-.302C1.498 3.078 1.675 3 2 3zM14 2H2C0 2 0 4 0 4v6c0 2 2 2 2 2h12c2 0 2-2 2-2V4c0-2-2-2-2-2"></path>
 </svg>
 </div>
 Cable TV 
 </a> 
 </li>
 @endif
 @if (sys_setting('airtime_cash') == 1)
 <li>
 <a href="{{route('bills.a2c')}}">
 <div class="icon-box bg_color_2">
 <svg xmlns=http://www.w3.org/2000/svg width=25 height=25 fill=#22c55e class="bi bi-tv" viewBox="0 0 16 16" style=stroke:#22c55e;stroke-width:0.2px>
 <path d="M5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0m1.138-1.496A6.6 6.6 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 0 0 .286-.958A7.6 7.6 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962"></path>
 <path fill-rule=evenodd d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069q0-.218-.02-.431c.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a1 1 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.74.74 0 0 0-.375.562c-.024.243.082.48.32.654a2 2 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595M2.516 6.26c.455-2.066 2.667-3.733 5.448-3.733 3.146 0 5.536 2.114 5.536 4.542 0 1.254-.624 2.41-1.67 3.248a.5.5 0 0 0-.165.535l.66 2.175h-.985l-.59-1.487a.5.5 0 0 0-.629-.288c-.661.23-1.39.359-2.157.359a6.6 6.6 0 0 1-2.157-.359.5.5 0 0 0-.635.304l-.525 1.471h-.979l.633-2.15a.5.5 0 0 0-.17-.534 4.65 4.65 0 0 1-1.284-1.541.5.5 0 0 0-.446-.275h-.56a.5.5 0 0 1-.492-.414l-.254-1.46h.933a.5.5 0 0 0 .488-.393m12.621-.857a.6.6 0 0 1-.098.21l-.044-.025c-.146-.09-.157-.175-.152-.223a.24.24 0 0 1 .117-.173c.049-.027.08-.021.113.012a.2.2 0 0 1 .064.199"></path>
 </svg>
 </div>
 airtime 2 cash
 </a> 
 </li>
 @endif
 <li>
 <a href="{{route('user.dashboard')}}">
 <div class="icon-box bg_color_2">
 <svg xmlns=http://www.w3.org/2000/svg width=25 height=25 fill=#22c55e class="bi bi-tv" viewBox="0 0 16 16" style=stroke:#22c55e;stroke-width:0.2px>
 <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"></path>
 <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118z"></path>
 </svg>
 </div>
 pay4me (soon)
 </a> 
 </li>
 <li>
 <a href="{{route('user.referral')}}">
 <div class="icon-box bg_color_2">
 <svg xmlns=http://www.w3.org/2000/svg width=25 height=25 fill=#22c55e class="bi bi-tv" viewBox="0 0 16 16" style=stroke:#22c55e;stroke-width:0.2px>
 <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 75 75 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0m-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233q.27.015.537.036c2.568.189 5.093.744 7.463 1.993zm-9 6.215v-4.13a95 95 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A61 61 0 0 1 4 10.065m-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68 68 0 0 0-1.722-.082z"></path>
 </svg>
 </div>
 Refer &amp; Earn 
 </a> 
 </li>
 <li>
 <a href="{{route('user.dashboard')}}">
 <div class="icon-box bg_color_2">
 <svg xmlns=http://www.w3.org/2000/svg width=25 height=25 fill=#22c55e class="bi bi-tv" viewBox="0 0 16 16" style=stroke:#22c55e;stroke-width:0.2px>
 <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"></path>
 <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"></path>
 </svg>
 </div>
 More (soon)
 </a> 
 </li> 
 </ul>
 </div>
 </div>
 </div>

 @endsection


 <!-- Footer Nav -->
 @include('user.layouts.footer')