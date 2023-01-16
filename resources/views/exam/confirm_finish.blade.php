<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ¡Has finalizado!
        </h2>
    </x-slot>

    <div class="py-12 h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex justify-center mt-5 text-2xl font-bold">
                        ¡Felicidades, has finalizado tu examen!
                    </div>
                    <div class="flex mt-6 justify-center text-xl font-extrabold">
                        Puedes revisar de nuevo tu examen
                    </div>
                    <div class="flex mt-2 justify-center text-base font-extrabold">
                        Si aún no estás seguro de tu examen.
                    </div>
                    <div class="flex justify-center text-base font-extrabold">
                        Puedes cliquear en el botón de abajo para rectificar todas tus respuestas.
                    </div>
                    <div class="flex mt-2 justify-center text-2xl font-extrabold">
                        <form action="{{route('exam.start')}}" method="post">
                            @csrf
                            <input type="submit"
                                   class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" value="Volver"></input>
                        </form>

                    </div>
                    <div class="flex mt-6 justify-center text-base font-extrabold">
                        Si ya estás seguro de tu examen
                    </div>
                    <div class="flex justify-center text-base font-extrabold">
                        Cliquea aquí abajo.
                    </div>
                    <div class="flex mt-2 justify-center text-2xl font-extrabold">
                        <form action="{{route('exam.finished')}}" method="post">
                            @csrf
                            <input type="submit"
                                   class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" value="Terminar"></input>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
