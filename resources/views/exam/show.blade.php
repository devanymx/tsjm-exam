<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Realiza tu examen aquí
        </h2>
    </x-slot>

    <div class="py-12 h-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex justify-center text-2xl font-extrabold">
                        ¡Bienvenido {{Auth::user()->name}}!
                    </div>
                    <div class="flex justify-center mt-5 text-xl font-bold">
                        Recuerda que sólo tienes 180 minutos para contestar.
                    </div>
                    <div class="flex justify-center text-2xl font-extrabold">
                        ¡Una vez empezado, no hay vuelta atrás!
                    </div>
                    <div class="flex justify-center mt-5">
                        <form action="{{route('exam.start')}}" method="post">
                            @csrf
                            <input type="submit"
                                    class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" value="Iniciar"></input>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
