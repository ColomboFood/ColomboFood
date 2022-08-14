<footer class="text-gray-600 body-font">

  <div class="container px-5 pt-12 mx-auto md:pt-24">
    <div class="flex flex-wrap order-first text-center md:text-left">

      <div class="w-full px-4 lg:w-1/4 md:w-1/2">
        <h2 class="mb-3 text-sm font-medium tracking-widest text-gray-900 title-font">SITEMAP</h2>
        <nav class="mb-10 list-none">
          <li>
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800">Home</a>
          </li>
          <li>
            <a href="{{ route('product.index') }}" class="text-gray-600 hover:text-gray-800">Negozio</a>
          </li>
        </nav>
      </div>

      <div class="w-full px-4 lg:w-1/4 md:w-1/2">
        <h2 class="mb-3 text-sm font-medium tracking-widest text-gray-900 title-font">LINK1</h2>
        <nav class="mb-10 list-none">
          <li>
            <a class="text-gray-600 hover:text-gray-800">First Link</a>
          </li>
          <li>
            <a class="text-gray-600 hover:text-gray-800">Second Link</a>
          </li>
          <li>
            <a class="text-gray-600 hover:text-gray-800">Third Link</a>
          </li>
          <li>
            <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
          </li>
        </nav>
      </div>

      <div class="w-full px-4 lg:w-1/4 md:w-1/2">
        <h2 class="mb-3 text-sm font-medium tracking-widest text-gray-900 title-font">LINK2</h2>
        <nav class="mb-10 list-none">
          <li>
            <a class="text-gray-600 hover:text-gray-800">First Link</a>
          </li>
          <li>
            <a class="text-gray-600 hover:text-gray-800">Second Link</a>
          </li>
          <li>
            <a class="text-gray-600 hover:text-gray-800">Third Link</a>
          </li>
          <li>
            <a class="text-gray-600 hover:text-gray-800">Fourth Link</a>
          </li>
        </nav>
      </div>

      <div class="w-full px-4 lg:w-1/4 md:w-1/2">
        <h2 class="mb-3 text-sm font-medium tracking-widest text-gray-900 title-font">{{ __('SUBSCRIBE') }}</h2>
        <div class="flex flex-wrap items-end justify-center xl:flex-nowrap md:flex-nowrap lg:flex-wrap md:justify-start">
          <div class="relative w-40 mr-2 sm:w-auto xl:mr-4 lg:mr-0 sm:mr-4">
            <label for="footer-field" class="text-sm leading-7 text-gray-600"></label>
            <input type="text" id="footer-field" name="footer-field" class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-gray-100 bg-opacity-50 border border-gray-300 rounded outline-none focus:bg-transparent focus:ring-2 focus:ring-secondary-200 focus:border-secondary-500">
          </div>
          <button class="inline-flex flex-shrink-0 px-6 py-2 text-white border-0 rounded bg-secondary-500 lg:mt-2 xl:mt-0 focus:outline-none hover:bg-secondary-600">Button</button>
        </div>
        <p class="mt-2 text-sm text-center text-gray-500 md:text-left">{{ __('Register to our newsletter') }}
        </p>

        <span class="inline-flex justify-center mt-12">
          <a class="text-gray-500">
            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
              <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
            </svg>
          </a>
          <a class="ml-3 text-gray-500">
            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
              <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
            </svg>
          </a>
          <a class="ml-3 text-gray-500">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
              <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
              <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
            </svg>
          </a>
          <a class="ml-3 text-gray-500">
            <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
              <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
              <circle cx="4" cy="4" r="2" stroke="none"></circle>
            </svg>
          </a>
        </span>
      </div>
      
    </div>

  </div>

  <div class="pt-4 bg-gray-100">
    <div class="container flex flex-col items-center px-5 py-2 mx-auto sm:flex-row">
      
      <a class="flex items-center justify-center font-medium text-gray-900 title-font md:justify-start">
        <x-jet-application-mark class="block w-auto h-9" />
        <span class="ml-3 text-xl">TALLCommerce</span>
      </a>
      <p class="mt-4 text-sm text-gray-500 sm:ml-6 sm:mt-0">© 2022 TALLCommerce —
        <a href="https://talale.it" rel="noopener noreferrer" class="ml-1 text-gray-600" target="_blank">Alessandro Talamona</a>
      </p>
    </div>
  </div>

</footer>