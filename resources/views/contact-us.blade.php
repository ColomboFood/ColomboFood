<x-app-layout>

    <x-google-map embed="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2799.6144129484005!2d9.213425210144122!3d45.43727358715696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4786c449e088668d%3A0xe189a6789606aaa2!2sVia%20Marco%20D&#39;Agrate%2C%2014%2C%2020139%20Milano%20MI!5e0!3m2!1sit!2sit!4v1675390573878!5m2!1sit!2sit">
        
        <div class="container flex px-5 py-24 mx-auto">
            <div class="relative z-10 flex flex-col w-full p-8 mt-10 bg-white shadow-md md:mr-12 lg:w-1/3 md:w-1/2 md:ml-auto md:mt-0">
                <h2 class="mb-2 text-lg font-semibold text-gray-900">{{ __('Contacts') }}</h2>
                <p class="text-gray-500">Box con informazioni di contatto</p>
                {{-- <div class="relative mb-4">
                    <label for="email" class="text-sm leading-7 text-gray-600">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-1 text-base leading-8 text-gray-700 transition-colors duration-200 ease-in-out bg-white border border-gray-300 rounded outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                </div>
                <div class="relative mb-4">
                    <label for="message" class="text-sm leading-7 text-gray-600">Message</label>
                    <textarea id="message" name="message" class="w-full h-32 px-3 py-1 text-base leading-6 text-gray-700 transition-colors duration-200 ease-in-out bg-white border border-gray-300 rounded outline-none resize-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200"></textarea>
                </div>
                <button class="px-6 py-2 text-lg text-white border-0 rounded bg-primary-500 focus:outline-none hover:bg-primary-600">Button</button>
                <p class="mt-3 text-xs text-gray-500">Chicharrones blog helvetica normcore iceland tousled brook viral artisan.</p> --}}
            </div>
        </div>
        
    </x-google-map>

</x-app-layout>