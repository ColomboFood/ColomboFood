<x-app-layout>

    <div class="w-full bg-bottom bg-cover h-64 lg:h-[32rem] " style="background-image: url('/img/homebanner.png')">
        <div class="py-12 mx-auto lg:container lg:pt-32">
            <div class="w-full px-6 py-4 mx-auto text-center bg-white lg:text-left lg:px-2 lg:w-96 lg:p-auto bg-opacity-80 lg:bg-opacity-0 lg:ml-20">
                <div class="mx-auto max-w-max">
                    <x-jet-application-logo class="mx-auto lg:w-full max-h-28 lg:max-h-none"/>
                </div>
            </div>
        </div>
    </div>

    <div class="container max-w-5xl px-6 py-12 mx-auto mb-12 prose">
        <div>
            <h2 class="mb-12 text-2xl font-bold">{{ __('About Us') }}</h2>
            <p>
                Ricordi spensierati trascorsi insieme a mio papà, tra bancali, furgoni e soprattutto tanti dolci e cibo
                di qualità. È da qui che nasce il mio interesse e la mia passione per il buon cibo e la sua distribuzione.
            </p>
            <p>
                È da qui che nel 2016 si realizza il mio sogno di bambino. Nasce Colombo Food.
            </p>
            <p>
                Colombo Food è oramai un'azienda consolidata nel settore e in continua crescita grazie alla passione
                e ai valori che portiamo avanti tutti insieme. È un lavoro difficile, orari massacranti, dedizione
                completa al cliente. Ma la vostra soddisfazione è il nostro motivo d'orgoglio.
            </p>
            <p>
                Il nostro team ha poche regole ma precise; <strong>il prodotto deve essere di qualità eccellente, la consegna
                al cliente deve essere puntuale e discreta</strong> e non bisogna mai smettere di cercare di migliorarsi.
            </p>
            <p>
                E oggi facciamo un altro passo per la nostra crescita con la creazione di colombofood.it; una piattaforma
                ecommerce che per noi ha l'obiettivo di aiutarvi a svolgere al meglio il vostro lavoro.
            </p>
            <p class="font-bold text-accent-500">
                Perchè siamo felici quando i vostri clienti sono felici.
            </p>
            <img class="h-10 mt-12 md:ml-auto md:mr-0" src="/img/pier-firma.png"/>
        </div>

        {{-- <div class="grid gap-6 mt-12 md:grid-cols-2 not-prose">
            <img class="object-cover h-64" src="/img/gastronomia.png"/>
            <img class="object-cover h-64" src="/img/pasta-fresca.png"/>
        </div> --}}
    </div>

</x-app-layout>