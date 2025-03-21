<div {{ $attributes }}>

  <!-- ========== HEADER ========== -->
  <header
    class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-[48] w-full bg-white border-b text-sm py-2.5 ">
    <nav class="max-w-[85rem] mx-auto w-full px-4 sm:px-6 lg:px-8 flex basis-full items-center w-full mx-auto">
      <div class="me-5">
        <!-- Logo -->
        <a class="flex-none rounded-md text-xl inline-block font-semibold focus:outline-none focus:opacity-80"
          href="{{ Route('/') }}" aria-label="logo">
          <img class="w-14 h-auto" src="{{ asset('logo/Untitled_design-removebg-preview.png') }}" alt="logo" />
        </a>
        <!-- End Logo -->

        <div class="lg:hidden ms-1">

        </div>
      </div>

      <div class="w-full flex items-center justify-end ms-auto md:justify-between gap-x-1 md:gap-x-3">
        <!-- Collapse -->
        <div class="md:hidden">
          <button type="button"
            class="hs-collapse-toggle size-[38px] relative inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
            id="hs-secondaru-navbar-collapse" aria-expanded="false" aria-controls="hs-secondaru-navbar"
            aria-label="Toggle navigation" data-hs-collapse="#hs-secondaru-navbar">
            <svg class="hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round">
              <line x1="3" x2="21" y1="6" y2="6" />
              <line x1="3" x2="21" y1="12" y2="12" />
              <line x1="3" x2="21" y1="18" y2="18" />
            </svg>
            <svg class="hs-collapse-open:block shrink-0 hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M18 6 6 18" />
              <path d="m6 6 12 12" />
            </svg>
            <span class="sr-only">Toggle navigation</span>
          </button>
        </div>
        <!-- End Collapse -->

        <div class="hidden md:block">

        </div>
        @if (Auth::user() && Auth::user()->type == "user")

      <div class="flex flex-row items-center justify-end gap-1">

        <a href="{{ Route('guest.notification') }}"
        class="size-[38px] relative inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
          <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
        </svg>
        <span class="sr-only">Notifications</span>
        </a>
      @endif

          <!-- Dropdown -->
          @if (!Auth::user())
        <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
        <button id="hs-dropdown-account" type="button"
          class="size-[38px] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
          aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
          <img class="shrink-0 size-[38px] rounded-full" src="{{ asset('images/profile/20171206_01.jpg') }}"
          alt="Avatar">
        </button>

        <div
          class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
          role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-account">
          <div class="py-3 px-5 bg-gray-100 rounded-t-lg">
          <p class="text-sm text-gray-500">Guest</p>
          </div>
          <div class="p-1.5 space-y-0.5">
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
            href="{{ Route('login') }}">
            <div class="w-4">
            @svg('entypo-login')
            </div>

            Login
          </a>
          <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
            href="{{ Route('register') }}">
            <div class="w-4">
            @svg('fas-plus')
            </div>
            Register
          </a>
          </div>
      @elseif (Auth::user() && (Auth::user()->type == "vendor"))
      <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
      <button id="hs-dropdown-account" type="button"
        class="size-[38px] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
        <img class="shrink-0 size-[38px] rounded-full" src="{{ Auth::user()->profile_photo_url }}"
        alt="Avatar">
      </button>

      <div
        class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-account">
        <div class="py-3 px-5 bg-gray-100 rounded-t-lg">
        <p class="text-sm text-gray-500">Signed in as</p>
        <p class="text-sm font-medium text-gray-800">{{ Auth::user()->email }}</p>
        </div>
        <div class="p-1.5 space-y-0.5">
        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
          href="{{ Route('dashboard') }}">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round">
          <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
          <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
          </svg>
          Dashboard
        </a>
        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
          href="#">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round">
          <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
          <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
          </svg>
          Property
        </a>
        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
          href="#">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round">
          <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
          <line x1="16" x2="16" y1="2" y2="6" />
          <line x1="8" x2="8" y1="2" y2="6" />
          <line x1="3" x2="21" y1="10" y2="10" />
          <path d="M8 14h.01" />
          <path d="M12 14h.01" />
          <path d="M16 14h.01" />
          <path d="M8 18h.01" />
          <path d="M12 18h.01" />
          <path d="M16 18h.01" />
          </svg>

          Bookings
        </a>
        </div>
        <hr />
        <div class="p-1.5 space-y-0.5">
        <form action="{{ route('logout') }}" method="post">
          @csrf
          <button type="submit"
          class="flex w-full items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-red-500 text-white hover:bg-red-300 focus:outline-none focus:bg-red-300 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300">
          <div class="shrink-0 size-4">
            @svg('entypo-login')

          </div>
          Logout
          </button>
        </form>
        </div>
    @elseif (Auth::user() && Auth::user()->type == "admin")
      <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
      <button id="hs-dropdown-account" type="button"
        class="size-[38px] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
        <img class="shrink-0 size-[38px] rounded-full" src="{{ Auth::user()->profile_photo_url }}"
        alt="Avatar">
      </button>

      <div
        class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-account">
        <div class="py-3 px-5 bg-gray-100 rounded-t-lg">
        <p class="text-sm text-gray-500">Signed in as</p>
        <p class="text-sm font-medium text-gray-800">{{ Auth::user()->email }}</p>
        </div>
        <div class="p-1.5 space-y-0.5">
        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
          href="{{ Route('admin.dashboard') }}">
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
          <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
          </svg>
          Dashboard
        </a>
        </div>
        <hr />
        <div class="p-1.5 space-y-0.5">
        <form action="{{ route('logout') }}" method="post">
          @csrf
          <button type="submit"
          class="flex w-full items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-red-500 text-white hover:bg-red-300 focus:outline-none focus:bg-red-300 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300">
          <div class="shrink-0 size-4">
            @svg('entypo-login')

          </div>
          Logout
          </button>
        </form>
        </div>
      </div>
  @elseif(Auth::user())
  <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
    <button id="hs-dropdown-account" type="button"
    class="size-[38px] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 focus:outline-none disabled:opacity-50 disabled:pointer-events-none"
    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
    <img class="shrink-0 size-[38px] rounded-full" src="{{ Auth::user()->profile_photo_url }}"
      alt="Avatar">
    </button>

    <div
    class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-account">
    <div class="py-3 px-5 bg-gray-100 rounded-t-lg">
      <p class="text-sm text-gray-500">Signed in as</p>
      <p class="text-sm font-medium text-gray-800">{{ Auth::user()->email }}</p>
    </div>
    <div class="p-1.5 space-y-0.5">
      <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
      href="{{ Route('guest.dashboard') }}">
      <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
      </svg>
      Dashboard
      </a>
      <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
      href="{{ Route('guest.purchases') }}">
      <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
        <path d="M3 6h18" />
        <path d="M16 10a4 4 0 0 1-8 0" />
      </svg>
      Purchases
      </a>
    </div>
    <div class="p-1.5 space-y-0.5">
      <form action="{{ route('logout') }}" method="post">
      @csrf
      <button type="submit"
        class="flex w-full items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm bg-red-500 text-white hover:bg-red-300 focus:outline-none focus:bg-red-300 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300">
        <div class="shrink-0 size-4">
        @svg('entypo-login')

        </div>
        Logout
      </button>
      </form>
    </div>
@endif


                        <!-- End Dropdown -->
                      </div>
                    </div>
    </nav>
  </header>
  <!-- ========== END HEADER ========== -->

  <!-- ========== MAIN CONTENT ========== -->
  <main id="content">
    <!-- Secondary Navbar -->
    <div class="md:py-4 bg-white md:border-b border-gray-200">
      <nav class="relative max-w-[85rem] w-full mx-auto md:flex md:items-center md:gap-3 px-4 sm:px-6 lg:px-8">
        <!-- Collapse -->
        <div id="hs-secondaru-navbar"
          class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block"
          aria-labelledby="hs-secondaru-navbar-collapse">
          <div
            class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300">
            <div class="py-2 md:py-0 flex flex-col md:flex-row md:items-center gap-y-0.5 md:gap-y-0 md:gap-x-6">
              <a class="py-4  bg-indigo-600 hover:bg-indigo-800 p-4 text-white md:py-0 flex items-center font-medium text-sm   transition-colors focus:outline-none focus:text-gray-500"
                href="#">
                List Your Property
              </a>
              <a class="py-2 md:py-0 flex items-center font-medium text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500"
                href="#">
                <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 12h.01" />
                  <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                  <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                  <rect width="20" height="14" x="2" y="6" rx="2" />
                </svg>
                About Us
              </a>
              <a class="py-2 md:py-0 flex items-center font-medium text-sm text-gray-800 hover:text-gray-500 focus:outline-none focus:text-gray-500"
                href="#">
                <svg class="shrink-0 size-4 me-3 md:me-2 block md:hidden" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round">
                  <path d="M12 12h.01" />
                  <path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" />
                  <path d="M22 13a18.15 18.15 0 0 1-20 0" />
                  <rect width="20" height="14" x="2" y="6" rx="2" />
                </svg>
                Contact Us
              </a>

              <!-- End Dropdown -->
            </div>
          </div>
        </div>
        <!-- End Collapse -->
      </nav>
    </div>
    <!-- End Secondary Navbar -->
    {{ $slot }}
  </main>
  <!-- ========== END MAIN CONTENT ========== -->

  <!-- ========== FOOTER ========== -->
  <footer class="mt-auto bg-gray-900 w-full">
    <div class="mt-auto w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 lg:pt-20 mx-auto">
      <!-- Grid -->
      <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
        <div class="col-span-full lg:col-span-1">
          <a class="flex-none rounded-md text-xl inline-block font-semibold focus:outline-none focus:opacity-80"
            href="#" aria-label="logo">
            <img class="w-20 h-auto" src="{{ asset('logo/Untitled_design-removebg-preview.png') }}" alt="logo" />
          </a>
        </div>
        <!-- End Col -->

        <div class="col-span-1">
          <!--
          <h4 class="font-semibold text-gray-100">Product</h4>

          <div class="mt-3 grid space-y-3">
            <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 focus:outline-none focus:text-gray-200"
                href="#">Pricing</a></p>
            <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 focus:outline-none focus:text-gray-200"
                href="#">Changelog</a></p>
            <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 focus:outline-none focus:text-gray-200"
                href="#">Docs</a></p>
          </div>
          ---->
        </div>
        <!-- End Col -->

        <div class="col-span-1">
          <!--

          <h4 class="font-semibold text-gray-100">Company</h4>

          <div class="mt-3 grid space-y-3">
            <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 focus:outline-none focus:text-gray-200"
                href="#">About us</a></p>
            <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 focus:outline-none focus:text-gray-200"
                href="#">Blog</a></p>
            <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 focus:outline-none focus:text-gray-200"
                href="#">Careers</a> <span
                class="inline-block ms-1 text-xs bg-blue-700 text-white py-1 px-2 rounded-lg">We're hiring</span></p>
            <p><a class="inline-flex gap-x-2 text-gray-400 hover:text-gray-200 focus:outline-none focus:text-gray-200"
                href="#">Customers</a></p>
          </div>

          ---->

        </div>
        <!-- End Col -->

        <div class="col-span-2">

        </div>
        <!-- End Col -->
      </div>
      <!-- End Grid -->

      <div class="mt-5 sm:mt-12 grid gap-y-2 sm:gap-y-0 sm:flex sm:justify-between sm:items-center">
        <div class="flex justify-between items-center">
          <p class="text-sm text-gray-400">
            © 2025 OnlineHotelBooking.com
          </p>
        </div>
        <!-- End Col -->

        <!-- Social Brands -->
        <div>
          <!--
          <a class="size-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 disabled:opacity-50 disabled:pointer-events-none"
            href="#">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              viewBox="0 0 16 16">
              <path
                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
            </svg>
          </a>
          <a class="size-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 disabled:opacity-50 disabled:pointer-events-none"
            href="#">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              viewBox="0 0 16 16">
              <path
                d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
            </svg>
          </a>
          <a class="size-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 disabled:opacity-50 disabled:pointer-events-none"
            href="#">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              viewBox="0 0 16 16">
              <path
                d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
            </svg>
          </a>
          <a class="size-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 disabled:opacity-50 disabled:pointer-events-none"
            href="#">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              viewBox="0 0 16 16">
              <path
                d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
            </svg>
          </a>
          <a class="size-10 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white hover:bg-white/10 focus:outline-none focus:bg-white/10 disabled:opacity-50 disabled:pointer-events-none"
            href="#">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              viewBox="0 0 16 16">
              <path
                d="M3.362 10.11c0 .926-.756 1.681-1.681 1.681S0 11.036 0 10.111C0 9.186.756 8.43 1.68 8.43h1.682v1.68zm.846 0c0-.924.756-1.68 1.681-1.68s1.681.756 1.681 1.68v4.21c0 .924-.756 1.68-1.68 1.68a1.685 1.685 0 0 1-1.682-1.68v-4.21zM5.89 3.362c-.926 0-1.682-.756-1.682-1.681S4.964 0 5.89 0s1.68.756 1.68 1.68v1.682H5.89zm0 .846c.924 0 1.68.756 1.68 1.681S6.814 7.57 5.89 7.57H1.68C.757 7.57 0 6.814 0 5.89c0-.926.756-1.682 1.68-1.682h4.21zm6.749 1.682c0-.926.755-1.682 1.68-1.682.925 0 1.681.756 1.681 1.681s-.756 1.681-1.68 1.681h-1.681V5.89zm-.848 0c0 .924-.755 1.68-1.68 1.68A1.685 1.685 0 0 1 8.43 5.89V1.68C8.43.757 9.186 0 10.11 0c.926 0 1.681.756 1.681 1.68v4.21zm-1.681 6.748c.926 0 1.682.756 1.682 1.681S11.036 16 10.11 16s-1.681-.756-1.681-1.68v-1.682h1.68zm0-.847c-.924 0-1.68-.755-1.68-1.68 0-.925.756-1.681 1.68-1.681h4.21c.924 0 1.68.756 1.68 1.68 0 .926-.756 1.681-1.68 1.681h-4.21z" />
            </svg>
          </a>
        </div>
         -->
          <!-- End Social Brands -->
        </div>
      </div>
  </footer>
  <!-- ========== END FOOTER ========== -->
</div>