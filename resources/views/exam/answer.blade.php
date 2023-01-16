<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Realiza tu examen aquí
        </h2>
    </x-slot>

    <div class="py-12 h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{route('exam.answer.questions')}}" method="post">
                    @csrf
                    <input type="text" class="sr-only" value="{{$page}}" name="page" id="page">
                    @foreach($questions as $question)
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                            <label class="text-base font-medium text-gray-900">{{$question->question}}</label>
                            <fieldset class="mt-4">
                                <legend class="sr-only">Notification method</legend>
                                <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                                    @foreach($question->answers as $answer)
                                        <div class="flex items-center">
                                            @php
                                                $trys = $user->questionAnswers()->where('slug',$answer->slug)->get();
                                            @endphp
                                            <input id="{{$answer->slug}}" value="{{$answer->slug}}" name="{{$question->slug}}" @checked(count($trys)>0) required type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="{{$answer->slug}}" class="pointer-events-none ml-3 mr-3 block text-sm font-medium text-gray-700">{{$answer->answer}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </fieldset>
                        </div>
                    @endforeach
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200 text-center">
                        <input type="submit"
                               class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" value="Siguiente">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

