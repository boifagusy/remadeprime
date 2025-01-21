<!DOCTYPE html><html lang="en"><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="theme-color" content="#ab2923">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="google-site-verification" content="c_LAXHEHxcNq1-aJO5h6KHVhmuVz7pgsx9HbbN7BXg">
<meta name="description" content="Fastest and easiest way to convert your airtime to cash. Accept payments for your business and services today using airtime.">
<meta name="keywords" content="Easiest way to convert airtime to cash in Nigeria, Make payment with airtime, Send and recieve payment in Nigeria with airtime, airtime is money, buy cheap data, MTN, Glo, 9mobile, Airtel, make payment for Gotv, Dstv">
<meta property="og:image" content="myimages/favicon.png"> 
<title>Vinepay - Easiest way to convert airtime to cash and buy data
</title>
<link rel="stylesheet" href="{{static_asset('css/tw/styles.css')}}">
<link rel="stylesheet" href="{{static_asset('css/tw/fonts.css')}}">
<link rel="stylesheet" href="{{static_asset('css/tw/sweetalert2.min.css')}}">
<link rel="stylesheet" href="{{static_asset('css/tw/all.min.css')}}">
<link rel="stylesheet" href="{{static_asset('css/tw/iziToast.min.css')}}">


<link rel="icon" href="{{my_asset(get_setting('myimages/atg-favicon.png'))}}">

<script src="{{static_asset('js/myjs/alpine.persist.min.js')}}" ></script>
<script src="{{static_asset('js/myjs/alpine.intersect.min.js')}}" ></script>
<script src ="{{static_asset('js/myjs/alpine.min.js')}}"></script>
<script src = "{{static_asset('js/myjs/axios.min.js')}}"></script>
<script>const BASE_URL = 'https://vinepay.net';</script>
<script src = "{{static_asset('js/myjs/iziToast.min.js')}}"></script>
<script src = "{{static_asset('js/myjs/sweetalert2.all.min.js')}}"></script>
<script src = "{{static_asset('js/myjs/utils.js')}}"></script>


<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-90432823"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'UA-90432823-1');
  </script>
</head>
<body class="font-body">
<header x-ref="header" x-data="{scrolled: false, mnav_opened: false}" x-init="() => {
    window.addEventListener('scroll', e => {
      let { scrollY } = window
      scrolled = scrollY > ($refs.header.offsetHeight + 20)
    })
  }" class="fixed inset-x-0 top-0 z-50 duration-500 bg-atg-light" :class="scrolled ? 'shadow-sm' : ''">
<div class="content">
<div class="flex items-center justify-between py-4">
<div>
<a href="https://vinepay.net">
<img class="h-12" src="{{my_asset('myimages/vinepay-logo.png')}}" alt="vinepay">
</a>
</div>
<div class="hidden lg:block">
<nav class="items-center hidden text-black lg:flex gap-x-10">
<a href="https://vinepay.net" class="duration-300 hover:underline hover:text-atg">
Home
</a>
<a href= "{{route('login')}}" class="duration-300 hover:underline hover:text-atg">
Airtime to Cash
</a>
<a href="{{route('login')}}" class="duration-300 hover:underline hover:text-atg">
Data
</a>
<a href="{{route('login')}}" class="duration-300 hover:underline hover:text-atg">
Pay4me
</a>
</nav>
</div>
<div>
<nav class="items-center hidden lg:flex gap-x-6">
<a href="{{route('login')}}" class="px-5 py-2 text-sm font-medium duration-500 border rounded lg:text-base text-atg hover:shadow-lg border-atg">
Login
</a>
<a href="{{route('register')}}" class="px-5 py-2 text-sm font-medium text-white duration-500 border rounded lg:text-base hover:bg-primary-600 bg-atg hover:shadow-lg border-atg">
Create Account
</a>
</nav>
<nav class="lg:hidden">
<a href="" @click.prevent="mnav_opened = !mnav_opened" class="inline-flex items-center justify-center w-8 h-8 border rounded-full text-atg border-atg">
<i class="fa" :class="mnav_opened ? 'fa-times' : 'fa-bars'"></i>
<span class="hidden">Menu</span>
</a>
</nav>
</div>
</div>
<div class="pb-10 mt-5 lg:hidden" :class="mnav_opened ? '' : 'hidden'">
<div class="grid gap-5 text-center">
<a href="https://vinepay.net" class="duration-300 hover:underline hover:text-atg">
Home
</a>
<a href="{{route('login')}}" class="duration-300 hover:underline hover:text-atg">
Airtime to Cash
</a>
<a href="{{route('login')}}" class="duration-300 hover:underline hover:text-atg">
Data
</a>
<a href="{{route('login')}}" class="duration-300 hover:underline hover:text-atg">
Pay4me
</a>
<a href= "{{route('login')}}" class="px-5 py-2 text-sm font-medium duration-500 border rounded lg:text-base text-atg hover:shadow-lg border-atg">
Login
</a>
<a href= "{{route('register')}}"  class="px-5 py-2 text-sm font-medium text-white duration-500 border rounded lg:text-base bg-atg hover:shadow-lg border-atg">
Create Account
</a>
</div>
</div>
</div>
</header>
<main>
<section class="pt-6 lg:pt-16 bg-atg-light">
<div class="content lg:py-20">
<div class="grid grid-cols-1 gap-10 lg:grid-cols-2">
<div class="py-20">
<h1 class="text-4xl font-bold leading-snug lg:text-6xl lg:leading-[1.2]">
The Best  <span class="text-atg"> Bills Payment </span> with eas online.
</h1>
<p class="mt-6">
Convert your airtime to cash, instant airtime and data delivery, make bill payments
with vinepay. The all-in-one payments app.
</p>
<div class="flex mt-12 gap-x-5">
<a target="_blank" href="https://apps.apple.com/ng/app/vinepay-airtime-to-cash/id15242316" class="inline-flex items-center justify-between py-3 text-sm tracking-wide text-white duration-300 bg-black rounded-lg hover:scale-105 hover:bg-gray-900 px-7">
<i class="mr-4 text-xl fab fa-apple"></i>
<div>
<div class="text-xs font-light">Get it on</div>
<div class="font-bold">App Store</div>
</div>
</a>
<a target="_blank" href="https://play.google.com/store/apps/details?id=com.nex.vinepay" class="inline-flex items-center justify-between py-3 text-sm tracking-wide text-white duration-300 bg-black rounded-lg hover:scale-105 hover:bg-gray-900 px-7">
<i class="mr-4 text-xl fab fa-google-play"></i>
<div>
<div class="text-xs font-light">Download on</div>
<div class="font-bold">Play Store</div>
</div>
</a>
</div>
<div class="mt-10">
<a href="">
<i class="mr-2 fa fa-circle animate-pulse text-atg"></i>
New to Airtime to cash? </a><a href= "{{route('login')}}" class="underline hover:no-underline">How it
works
</a>
</div>
</div>
<div class="justify-end hidden lg:flex">
<img class="w-11/12 h-auto" src="{{my_asset('myimages/i88.webp')}}" alt="">
</div>
</div>
</div>
</section>
<section class="bg-no-repeat bg-[length:35%] lg:bg-[center_right_-200px]" style="background-image: url('myimages/bg-util.png')  ;">
<div class="pt-20 lg:pb-24 lg:pt-32">
<div class="content">
<h2 class="pl-10 text-2xl font-bold border-l-4 lg:text-4xl border-atg lg:leading-snug">
Join over <span class="text-atg">5k</span> <br>
people who use Vinepay.
</h2>
<div class="grid grid-cols-1 gap-8 mt-20 lg:gap-14 lg:grid-cols-3">
<div class="relative p-6 duration-500 bg-gray-100 rounded-lg shadow lg:p-10 hover:-translate-y-2 hover:bg-gray-50">
<div>
<img class="w-10 h-10"  src="{{my_asset('myimages/send-receive.png')}}" alt="Airtime to Cash">
</div>
<div class="mt-5 font-bold text-atg">
Instant Airtime to Cash
</div>
<div class="mt-4 font-light">
Convert your airtime to cash in seconds using the new and improved Airtime to cash service.
</div>
</div>
<div class="relative p-6 duration-500 bg-gray-100 rounded-lg shadow hover:-translate-y-2 hover:bg-gray-50">
<div>
<img class="w-10 h-10" src="{{my_asset('myimages/nairapin.png')}}" alt="Airtime topup">
</div>
<div class="mt-5 font-semibold text-atg">
Airtime Topup
</div>
<div class="mt-4 font-light">
Purchase airtime for MTN, Glo, 9mobile &amp; Airtel at the best possible @ discounted rates.
</div>
</div>
<div class="relative p-6 duration-500 bg-gray-100 rounded-lg shadow hover:-translate-y-2 hover:bg-gray-50">
<div>
<img class="w-10 h-10" src="{{my_asset('myimages/data.png')}}" alt="Data purchase">
</div>
<div class="mt-5 font-semibold text-atg">
Data Purchase
</div>
<div class="mt-4 font-light">
We offer the best rates on data purchase for all available networks in Nigeria.
</div>
</div>
<div class="relative p-6 duration-500 bg-gray-100 rounded-lg shadow hover:-translate-y-2 hover:bg-gray-50">
<div>
<img class="w-10 h-10" src="{{my_asset('myimages/bill.png')}}" alt="Bill Payment">
</div>
<div class="mt-5 font-semibold text-atg">
Bill Payments
</div>
<div class="mt-4 font-light">
Pay for your Tv/Cable (Dstv, Gotv, etc.), Internet, Electricity &amp; other merchants using the vinepay app.
</div>
</div>
<div class="relative p-6 duration-500 bg-gray-100 rounded-lg shadow hover:-translate-y-2 hover:bg-gray-50">
<div>
<img class="w-10 h-10"  src="{{my_asset('myimages/buy-tv.png')}}"  alt="Airtime Payments">
</div>
<div class="mt-5 font-semibold text-atg">
Airtime Payments
</div>
<div class="mt-4 font-light">
Send and receive payments, pay bills &amp; Receive &amp; send cash using Vinepay.
</div>
</div>
<div class="relative p-6 duration-500 bg-gray-100 rounded-lg shadow hover:bg-gray-50 hover:-translate-y-2">
<div class="relative z-10">
<div>
<img class="w-10 h-10" src="{{my_asset('myimages/send-receive.png')}}"  alt="Airtime to Cash">
</div>
<div class="mt-5 font-semibold text-atg">
Pay4me (soon)
</div>
<div class="mt-4 font-light">
Best way to stay away from scammers and buy product from anyone online.
</div>
</div>
<div class="absolute inset-x-0 bottom-0 z-0 duration-300 bg-atg"></div>
</div>
</div>
</div>
</div>
<div class="pt-16 lg:pb-20">
<div class="content">
<h2>
<div class="flex justify-center">
<span class="px-3 py-1 text-sm text-white rounded-lg bg-atg">
Why Vinepay?
</span>
</div>
<div class="mt-6 text-3xl font-bold leading-normal text-center lg:text-4xl">
Transactions Made Easy!
</div>
</h2>
<div class="grid grid-cols-1 gap-5 mt-10 lg:mt-20 lg:gap-10 lg:grid-cols-4">
<div class="p-5 text-center rounded lg:py-7 bg-atg-light">
<div class="flex justify-center">
<img class="h-10 lg:h-12" src="{{my_asset('myimages/pattern-lock.png')}}" alt="Seamless transaction">
</div>
<div class="mt-5 font-bold">
Seamless Transactions.
</div>
<div class="mt-5 text-sm font-light">
vinepay is structured in a manner that makes it easy to use so that you can conveniently access &amp; perform
transactions.
</div>
<div class="mt-6 text-sm font-medium text-atg">
<a href="" class="group">
Learn More
<i class="ml-1 duration-300 fa fa-angle-right group-hover:ml-2"></i>
</a>
</div>
</div>
<div class="p-5 text-center rounded lg:py-7 bg-atg-light">
<div class="flex justify-center">
<img class="h-10 lg:h-12" src="{{my_asset('myimages/headphones.png')}}" alt="Customer Support">
</div>
<div class="mt-5 font-bold">
Customer Support.
</div>
<div class="mt-5 text-sm font-light">
Get prompt response to your complaints, issues or enquiries by using any of our available call or social
channels.
</div>
<div class="mt-6 text-sm font-medium text-atg">
<a href="" class="group">
Contact Us
<i class="ml-1 duration-300 fa fa-angle-right group-hover:ml-2"></i>
</a>
</div>
</div>
<div class="p-5 text-center rounded lg:py-7 bg-atg-light">
<div class="flex justify-center">
<img class="h-10 lg:h-12"  src="{{my_asset('myimages/cyber-security.png')}}" alt="Security">
</div>
<div class="mt-5 font-bold">
Security.
</div>
<div class="mt-5 text-sm font-light">
vinepay has embraced technology in its operations to ensure that you can peform transactions securely and
efficiently.
</div>
<div class="mt-6 text-sm font-medium text-atg">
<a href="" class="group">
Read More
<i class="ml-1 duration-300 fa fa-angle-right group-hover:ml-2"></i>
</a>
</div>
</div>
<div class="p-5 text-center rounded lg:py-7 bg-atg-light">
<div class="flex justify-center">
<img class="h-10 lg:h-12"  src="{{my_asset('myimages/clock.png')}}" alt="Fast and reliable">
</div>
<div class="mt-5 font-bold">
Fast &amp; Reliable.
</div>
<div class="mt-5 text-sm font-light">
With experience, we have learnt in the past years to be able to fully optimize our platform for speed and
dependability.
</div>
<div class="mt-6 text-sm font-medium text-atg">
<a href="" class="group">
More Info
<i class="ml-1 duration-300 fa fa-angle-right group-hover:ml-2"></i>
</a>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="pt-12 lg:pb-24">
<div class="content">
<div class="p-5 overflow-hidden text-white rounded-lg bg-atg lg:p-20">
<div class="grid grid-cols-1 gap-10 lg:gap-20 lg:grid-cols-2">
<div>
<div class="text-2xl font-bold lg:text-4xl">
Download the app...
</div>
<p class="mt-6 text-sm leading-normal tracking-wide lg:text-base">
Join thousands of customers enjoying day to day seamless transactions using our mobile app.
</p>
</div>
<div class="lg:flex lg:items-center lg:justify-center">
<div class="flex gap-x-3 lg:gap-x-6">
<div>
<a target="_blank" href="https://apps.apple.com/ng/app/vinepay-airtime-to-cash/id1545123" class="flex items-center justify-between px-4 py-3 text-sm tracking-wide text-white duration-300 bg-black rounded-lg hover:scale-105 hover:bg-gray-900 lg:px-7">
<i class="mr-4 text-xl fab fa-apple"></i>
<div>
<div class="text-xs font-light">Get it on</div>
<div class="font-bold">App Store</div>
</div>
</a>
</div>
<div>
<a target="_blank" href="https://play.google.com/store/apps/details?id=com.nex.vinepay" class="flex items-center justify-between px-4 py-3 text-sm tracking-wide text-white duration-300 bg-black rounded-lg hover:scale-105 hover:bg-gray-900 lg:px-7">
<i class="mr-4 text-xl fab fa-google-play"></i>
<div>
<div class="text-xs font-light">Download on</div>
<div class="font-bold">Play Store</div>
</div>
</a>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</main>
<footer class="pt-10 pb-12 mt-10 text-sm text-white bg-black lg:mt-0">
<div class="content">
<div class="grid grid-cols-2 lg:grid-cols-5 gap-y-10 lg:gap-y-0 lg:gap-x-10">
<div class="col-span-2 lg:items-start lg:col-span-1">
<div>
<img class="h-12"  src="{{my_asset('myimages/vinepay-logo.png')}}" alt="">
</div>
<div class="hidden mt-1 italic text-gray-300 lg:block">
Pay bill with easy...
</div>
<div class="mt-4 text-xs text-gray-400">
Vinepay is a financial technology company, not a bank. All our partner banks and card service providers are
duly licensed.
</div>
</div>
<div>
<div class="font-semibold text-w">
Products
</div>
<ul class="mt-6 space-y-4 text-gray-400">
<li>
<a href= "{{route('login')}}" class="hover:text-atg">
Airtime to Cash
</a>
</li>
<li>
<a href= "{{route('login')}}" class="hover:text-atg">
Pay4me
</a>
</li>
<li>
<a href="{{route('login')}}" class="hover:text-atg">
Data Topup
</a>
</li>
</ul>
</div>
<div>
<div class="font-semibold text-w">
Company
</div>
<ul class="mt-6 space-y-4 text-gray-400">
<li>
<a href="" class="hover:text-atg">
About
</a>
</li>
<li>
<a href="https://vinepay.com/blog" class="hover:text-atg">
Our Blog
</a>

</li>
<li>
<a href="https://vinepay.com/privacy-policy" class="hover:text-atg">
Privacy Policy
</a>
</li>
<li>
<a href="https://vinepay.com/terms" class="hover:text-atg">
Terms of Service
</a>
</li>
</ul>
</div>
<div>
<div class="font-semibold text-w">
Developers (coming soon)
</div>
<ul class="mt-6 space-y-4 text-gray-400">
<li>
<a href="" class="hover:text-atg">
API Reference
</a>
</li>
<li>
<a href="" class="hover:text-atg">
Documentation
</a>
</li>
<li>
<a href="" class="hover:text-atg">
Libraries
</a>
</li>
</ul>
</div>
<div>
<ul class="space-y-4 text-gray-400">
<li class="flex space-x-5 text-lg text-gray-500">
<a target="_blank" href="{{get_setting('facebook')}}" class="hover:text-atg">
<i class="fab fa-facebook"></i>
</a>
<a target="_blank" href="{{get_setting('twitter')}}" class="hover:text-atg">
<i class="fab fa-twitter"></i>
</a>
<a target="_blank" href="{{get_setting('instagram')}}" class="hover:text-atg">
<i class="fab fa-instagram"></i>
</a>
<a target="_blank" href="{{get_setting('whatsapp')}}" class="hover:text-atg">
<i class="fab fa-whatsapp"></i>
</a>
</li>


<li>
<a href="mailto:vinepay@gmail.com" class="hover:text-atg">
vinepay@gmail.com
</a>
</li>
<li>
<a href="tel:+2347072684620" class="hover:text-atg">
(+234) 707 268 4620
</a>
</li>
<li>
Obafuwa Street Ogere Ogun. Ogun state.
</li>
</ul>
</div>
</div>
<div class="py-5 mt-12 text-center text-gray-600 border-t border-b border-gray-800">
© 2024 ·
Berniza Global Solution Ventures.
</div>
</div>
</footer>

<script data-cfasync="false" src = "{{static_asset('js/myjs/email-decode.min.js')}}"></script>
</body></html>