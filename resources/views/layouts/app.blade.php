<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    <title>{{ __('nav.app_name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
<nav class="bg-white border-gray-200 dark:bg-gray-900 shadow-md">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    
    <!-- الجزء الأيسر: اللوجو -->
    <div class="flex items-center gap-3">
      <a href="{{ url('/') }}" class="flex items-center gap-3">
        <img src="https://flowbite.com/docs/images/logo.svg" class="h-7" alt="Logo" />
       <span class="self-center text-black text-2xl font-semibold whitespace-nowrap dark:text-white">
          {{ __('nav.app_name') }}
        </span>
      </a>
    </div>

    <div class="flex items-center gap-3 order-2 md:order-3">
      <!-- Language & Theme toggles -->
      <div class="flex gap-3 items-center">
        <!-- Language -->
        <button
          id="lang-toggle"
          class="px-3 py-1 rounded-full bg-blue-500 text-white font-bold shadow-md hover:scale-105 transition"
        >
          {{ app()->getLocale() === 'en' ? 'AR' : 'EN' }}
        </button>

        <!-- Theme -->
        <button id="theme-toggle"
          class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:scale-110 transition">
          <i data-lucide="moon" class="w-5 h-5 block dark:hidden "></i>
          <i data-lucide="sun" class="w-5 h-5 hidden dark:block"></i>
        </button>
      </div>

      <!-- Mobile menu button -->
      <button data-collapse-toggle="navbar-default" type="button"
          class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg 
          md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 
          dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
          aria-controls="navbar-default" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M1 1h15M1 7h15M1 13h15" />
          </svg>
      </button>
    </div>

    <!-- Main menu -->
    <div class="hidden w-full md:block md:w-auto order-3 md:order-2" id="navbar-default">
      <ul
        class="font-medium flex flex-col p-4 gap-4 md:p-0 mt-4 border border-gray-100 rounded-lg 
        bg-gray-50 md:flex-row  md:mt-0 md:border-0 
        md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700"
      >
        <li>
          <a href="{{ url('/') }}"
            class="block py-2 px-3 rounded-sm md:p-0 
            {{ request()->is('/') ? 'text-blue-700 dark:text-blue-500' : 'text-gray-900 dark:text-white hover:text-blue-700 md:hover:text-blue-700' }}">
            {{ __('nav.home') }}
          </a>
        </li>
        <li>
          <a href="{{ url('/users') }}"
            class="block py-2 px-3 rounded-sm md:p-0 
            {{ request()->is('users') ? 'text-blue-700 dark:text-blue-500' : 'text-gray-900 dark:text-white hover:text-blue-700 md:hover:text-blue-700' }}">
            {{ __('nav.users') }}
          </a>
        </li>
      </ul>
    </div>

  </div>
</nav>


    <main class="p-8">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</body>
</html>
