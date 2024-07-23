<section id="home" class="w-full flex xl:flex-row flex-col justify-center   max-container">
    <div class="relative xl:w-2/5 bg-gray-400 flex flex-col justify-center items-start w-full max-xl:px-24 px-12 pt-28">
        <p class="text-xl text-gray-100 font-montserrat text-coral-red">ANG MOTORCYCLE SHOP NG BAYAN</p>
        <h1 class="mt-10 font-palanquin text-8xl max-sm:text-8xl max-sm:leading-82px font-bold text-yellow-50 md:z-1">
            <span class="xl:bg-red-900 xl:whitespace-nowrap relative z-10 max-lg:z-0 pr-10 text-yellow-50">Sulit ka dito!</span><br/>
           Superbikes
        </h1>
        <p class="font-montserrat text-slate-gray text-lg leading-8 mt-6 mb-14 sm:max-w-sm">
            Encontre as novidades para pedalar com segurança, velocidade, e com bom preço.
        </p>
        <div>
            <button href="{{ route('motorcycles.index') }}" wire:navigate  class="bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                See all motorcycles
            </button>
        </div>

        <div class="flex justify-start items-start flex-wrap w-full mt-20 gap-16">
        </div>
    </div>
    <div class="relative flex-1 flex justify-center items-center bg-gray-800 max-xl:py-40 bg-primary bg-cover bg-center"
        style="background-image: url('{{ asset('https://ic.maxabout.us/bikes/yamaha/2022-yamaha-aerox-155/2022-Yamaha-Aerox-155-13.jpg') }}');">
    <!-- Content inside the background image div -->
    </div>

</section>
