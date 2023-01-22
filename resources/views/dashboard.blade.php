<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de administración
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <span class="isolate inline-flex rounded-md shadow-sm">
                      <a href="{{route('dashboard', ['score' => 'excellent', 'filter' => true])}}"
                              class="inline-flex items-center rounded-l-md border border-gray-300 bg-emerald-50 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-secondary hover:text-white focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"> Excelente </a>
                      <a href="{{route('dashboard', ['score' => 'regular', 'filter' => true])}}"
                              class="inline-flex items-center border border-gray-300 bg-amber-50 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-secondary hover:text-white focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"> Regular </a>
                      <a href="{{route('dashboard', ['score' => 'bad', 'filter' => true])}}"
                              class="inline-flex items-center rounded-r-md border border-gray-300 bg-red-50 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-secondary hover:text-white focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">Mal</a>
                        <a href="{{route('dashboard', ['score' => 'done', 'filter' => true])}}"
                           class="inline-flex items-center rounded-r-md border border-gray-300 bg-slate-50 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-secondary hover:text-white focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">Resueltos</a>
                    </span>
                    <div class="inline-flex rounded-md shadow-sm mr-5">
                        <div class="mt-1">
                            <form action="{{route('dashboard')}}" class="inline-flex" method="GET">
                                <label for="text_filter" class="sr-only">Filtro de texto</label>
                                <input type="text" name="text" id="text_filter"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Filtra nombre o email">
                                <input type="text" name="filter" value="1" class="sr-only">
                                <input type="submit" class="inline-flex items-center rounded-r-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-secondary hover:text-white focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            </form>
                        </div>
                    </div>
                    @if($filters)
                        <span class="isolate inline-flex rounded-md shadow-sm float-right	">
                          <a href="{{route('dashboard')}}"
                             class="inline-flex items-center rounded-l-md rounded-r-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"> Limpiar filtros </a>
                        </span>
                    @endif
                </div>
                <div class="overflow-hidden bg-white shadow sm:rounded-md">
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach($users as $user)
                            @if($user->membership->role == 'user')
                                <li>
                                    @php
                                        $classes = '';

                                        if ($user->exam){
                                            if ($user->exam->score){
                                                $classes .= $user->exam->score >= 80 ? 'bg-emerald-100' : '';
                                                $classes .= $user->exam->score >= 60 && $user->exam->score <= 79 ? 'bg-amber-100' : '';
                                                $classes .= $user->exam->score >= 0 && $user->exam->score <= 59 ? 'bg-red-100' : '';
                                                $classes .= $user->exam->score == null ? 'bg-slate-200' : '';
                                            }else{
                                                $classes .= 'bg-slate-200';
                                            }
                                        }else{
                                            $classes .= 'bg-slate-200';
                                        }
                                    @endphp
                                    <div class="block {{$classes}} flex items-center px-4 py-4 sm:px-6">
                                        <div class="flex min-w-0 flex-1 items-center">
                                            <div class="flex-shrink-0">
                                                <img class="h-12 w-12 rounded-full"
                                                     src="{{ $user->profile_photo_url() }}" alt="{{$user->name}}"/>
                                            </div>
                                            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-3 md:gap-4">
                                                <div>
                                                    <p class="truncate text-sm font-medium text-principal">{{$user->name}}</p>
                                                    <p class="mt-2 flex items-center text-sm text-gray-500">
                                                        <!-- Heroicon name: mini/envelope -->
                                                        <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400"
                                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                             fill="#9b012a" aria-hidden="true">
                                                            <path
                                                                d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z"/>
                                                            <path
                                                                d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z"/>
                                                        </svg>
                                                        <span class="truncate text-secondary">&nbsp;{{$user->email}}</span>
                                                    </p>
                                                </div>
                                                @if($user->exam)
                                                    @if($user->exam->score)
                                                        <div class="md:block">
                                                            <div>
                                                                <p class="text-sm text-gray-900 flex">
                                                                    <svg
                                                                        class="mr-1.5 h-5 w-5 flex-shrink-0 text-green-400"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 20 20" fill="currentColor"
                                                                        aria-hidden="true">
                                                                        <path fill-rule="evenodd"
                                                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                                              clip-rule="evenodd"/>
                                                                    </svg>
                                                                    &nbsp;
                                                                    Examen terminado en:
                                                                </p>
                                                                <p class="flex items-center text-sm text-gray-500">
                                                                    {{$user->exam->time}} horas
                                                                </p>
                                                                <p class="flex items-center text-sm text-gray-500">
                                                                    Finalizado en: {{$user->exam->finished_at}}
                                                                </p>
                                                                <p class="flex items-center text-sm text-gray-500">
                                                                    Calificación: {{$user->exam->score / 10}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="md:block">
                                                            <div>
                                                                <p class="text-sm text-gray-900 flex">
                                                                    <a href="{{route('exam.auditory', ['uuid' => $user->exam->uuid])}}" target="_blank">Click para descargar examen</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    @if(!$filters)
                        <div class="p-6 sm:px-20 mt-6 pb-10 bg-white border-b border-gray-200">
                            {!! $users->links() !!}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
