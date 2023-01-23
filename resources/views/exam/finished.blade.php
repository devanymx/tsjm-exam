<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ¡Has finalizado!
        </h2>
    </x-slot>

    <div class="py-12 h-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200 h-full">
                    <div class="w-full mt-8">
                        <div class="float-left">
                            <img src="{{ asset('images/tsj.jpg') }}" width="100px" alt="Logo del Tribunal Superior de Justicia de Morelos">
                        </div>
                        <div class="float-right">
                            <div class="flex justify-center text-sm font-extrabold">
                                {!! QrCode::size(100)->backgroundColor(255,255,255)->generate($url) !!}
                            </div>
                            <div class="flex justify-center text-sm font-extrabold">
                                (QR de cifrado)
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-44 mb-10 text-2xl font-bold">
                        ¡Felicidades {{$user->name}}, has finalizado tu examen!
                    </div>
                    <div class="flex justify-center mt-8 text-xl font-bold">
                        “La vida es mejor para quienes hacen lo posible para tener lo mejor”
                    </div>
                    <div class="flex justify-center mb-10 text-xl font-bold">
                        Muchas gracias.
                    </div>
                    <div class="flex mt-8 justify-center text-sm font-extrabold">
                        <span class="inline-flex items-center rounded-md border border-transparent bg-principal px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Espera tu turno para seguir.
                        </span>
                    </div>
                    <div class="flex mt-20 justify-center text-sm font-extrabold">
                        Este examen está cifrado.
                    </div>
                    <div class="flex justify-center text-sm font-extrabold">
                        Para verificar la veracidad de este certificado, escanea el código QR o ingresa al enlace:
                    </div>
                    <div class="flex mb-20 justify-center text-sm font-extrabold">
                        <a href="{{$url}}">{{$url}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
