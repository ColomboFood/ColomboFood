<x-app-layout>

    <div class="w-full h-[32rem] bg-cover bg-right-bottom"
        style="background-image: url('/img/homebanner.png')"
    >
        <div class="container pt-24 mx-auto lg:pt-32">
            <x-jet-application-logo class="w-full px-6 py-4 mx-auto bg-white sm:px-2 sm:w-96 md:p-auto bg-opacity-80 md:bg-opacity-0 md:ml-6 lg:ml-20 lg:w-96"/>
        </div>
    </div>

    <div class="grid gap-6 my-6 md:mx-12 md:grid-cols-3">
        <div class="flex items-center justify-center h-24 bg-cover"
            style="background-image: url('/img/pasta.png')"
        >
            <span class="px-6 py-1 bg-white bg-opacity-80">Pasta fresca</span>
        </div>

        <div class="flex items-center justify-center h-24 bg-cover"
            style="background-image: url('/img/lasagne.png')"
        >
            <span class="px-6 py-1 bg-white bg-opacity-80">Gastronomia</span>
        </div>

        <div class="flex items-center justify-center h-24 bg-cover"
            style="background-image: url('/img/macaron.png')"
        >
            <span class="px-6 py-1 bg-white bg-opacity-80">Pasticceria</span>
        </div>
    </div>
    
    <div class="container mx-auto my-12">
        <h2 class="font-serif text-2xl font-bold text-center text-gray-900">I nostri <span class="text-primary-500">Best Seller</span></h2>
    
        <div class="grid grid-cols-2 mx-4 my-12 gap-x-6 gap-y-12 md:mx-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">

            @foreach (range(1,10,1) as $i)
                <div class="flex flex-col items-center justify-center p-2 h-80">
                    <div class="relative h-48 overflow-hidden group">
                        <img class="object-cover h-full transition duration-500 transform group-hover:scale-90" src="img/no_image.jpg"/>
                        <div class="absolute top-0 block w-1/2 h-full transform -skew-x-12 -inset-full z-5 bg-gradient-to-r from-transparent to-white opacity-40 group-hover:animate-shine"></div>
                    </div>
                    <div class="text-lg font-bold">Baci di Dama</div>
                    <div>200 gr.</div>
                    <div class="flex-none w-full mt-auto mb-0">
                        <x-jet-button class="justify-center w-full">Scopri</x-jet-button>
                    </div>
                </div>
            @endforeach
        
        </div>

    </div>

    <div class="container flex grid w-full gap-6 px-4 mx-auto my-12 md:px-12 md:grid-cols-2 lg:grid-cols-5">
        
        <div class="flex items-center justify-center px-6 pt-6 pb-10 bg-warning-100 lg:col-span-2 bg-opacity-60">
            <div class="flex flex-col">
                <p>Cerchi un prodotto particolare che non trovi sul sito?</p>
                <p>Scrivi a <a class="underline" href="mailto:info@info.it">info@colombofood.it</a></p>
            </div>
        </div>

        <div class="flex flex-col px-4 py-10 bg-gray-500 lg:flex-row lg:col-span-3 bg-opacity-60">
            <div class="flex flex-col mb-12 text-center lg:mb-0 lg:ml-auto lg:mr-0">
                <p>Consegna in tutta Italia!</p>
                <a class="underline" href="">Guarda le tariffe</a>
            </div>
            <img class="h-32 ml-auto mr-12 -mb-10" src="/img/no_image.jpg" />
        </div>

    </div>

    <div class="w-full text-gray-600 bg-gray-200">
        <div class="container flex flex-col w-full mx-auto my-12 md:h-96 md:flex-row">
            <img class="object-cover object-top h-64 lg:w-full md:max-w-xs lg:max-w-none md:object-center md:h-full lg:h-auto" 
                src="/img/shop.png"
                
            />
            <div class="flex flex-col items-center w-full">
                <div class="max-w-sm pt-4 pb-10 ml-4 md:pt-0 md:pb-0 md:mt-12">
                    <p class="text-3xl font-bold">Hai la partita Iva?</p>
                    <p class="mt-6">
                        ColomboFood ha studiato una serie di offerte dedicate e personalizzate rivolte ai commercianti,
                        proprietari di bar, panetterie o piccole attività, che hanno delle esigenze particolari.
                    </p>
                    <p class="mt-6 font-bold">
                        Perchè a volte avere la Partita Iva può essere un vantaggio!
                    </p>
                    <div class="mt-6">
                        <x-jet-button class="px-12">Scopri i vantaggi</x-jet-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full">
        <div class="container flex flex-col w-full mx-auto my-12 md:h-96 md:flex-row">
            <div class="flex flex-col items-center w-full">
                <div class="max-w-sm pt-4 pb-10 mr-12 text-right md:pt-0 md:pb-0 md:mt-12">
                    <p class="text-3xl font-bold text-primary-500">Da oggi puoi ritirare direttamente nel nostro magazzino!</p>
                    <p class="mt-2">
                        Organizza il tuo ritiro chiamandoci al
                        <span class="inline-block">+39 02 392 835 39</span>
                    </p>
                </div>
            </div>
            <img class="object-cover object-top h-64 lg:w-full md:max-w-xs lg:max-w-none md:object-center md:h-full lg:h-auto" src="/img/shipping.png"/>
        </div>
    </div>

</x-app-layout>