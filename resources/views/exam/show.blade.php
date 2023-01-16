<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Realiza tu examen aquí
        </h2>
    </x-slot>

    <div class="py-12 h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <h1>HTML Ipsum Presents</h1>

                    <p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac
                        turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.
                        Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris
                        placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat
                        wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit
                        eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a
                            href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p>
                    <h2>Header Level 2</h2>
                    <ol>
                        <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                        <li>Aliquam tincidunt mauris eu risus.</li>
                    </ol>
                    <blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at
                            felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec
                            eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit
                            amet quam. Vivamus pretium ornare est.</p></blockquote>
                    <h3>Header Level 3</h3>
                    <ul>
                        <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
                        <li>Aliquam tincidunt mauris eu risus.</li>
                    </ul>
                    <div class="flex justify-center mt-5 text-xl font-bold">
                        Recuerda que sólo tienes 120 minutos para contestar.
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
