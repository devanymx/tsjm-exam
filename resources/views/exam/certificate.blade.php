<x-guest-layout>
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
                    <div class="flex mt-28 justify-center text-sm font-extrabold">
                        Este examen está cifrado bajo una llave de dos partes, solamente tú y la persona con quien lo compartas tendrán acceso a tu calificación.
                    </div>
                    <div class="flex justify-center text-sm font-extrabold">
                        Para verificar la veracidad de este certificado, escanea el código QR o ingresa al enlace:
                    </div>
                    <div class="flex mb-28 justify-center text-sm font-extrabold">
                        <a href="{{$url}}">{{$url}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
