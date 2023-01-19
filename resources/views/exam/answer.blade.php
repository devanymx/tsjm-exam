<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Examen de oposición para Juez de primera instancia - <span id="demo"></span>
        </h2>
        <script>
            // Set the date we're counting down to
            let countDownDate = new Date('{{$finishDate}}').getTime();
            // Update the count-down every 1 second
            const x = setInterval(function() {

                // Get today's date and time
                let now = new Date().getTime();

                // Find the distance between now and the count-down date
                let distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the result in the element with id="demo"
                document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s ";

                // If the count-down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    window.location.href = "/exam/finished";
                    document.getElementById("demo").innerHTML = "EXPIRED";
                }
            }, 1000);
        </script>
    </x-slot>

    <div class="py-12 h-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{route('exam.answer.questions')}}" method="post">
                    @csrf
                    <label for="page"></label><input type="text" class="sr-only" value="{{$page}}" name="page" id="page">
                    @foreach($questions as $question)
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                            <label class="text-base font-medium text-gray-900"><span class="text-xl font-bold">{{($loop->iteration) + ($divisor * 10)}}.- </span>{{$question->question}}</label>
                            <fieldset class="mt-4">
                                <legend class="sr-only">Notification method</legend>
                                <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                                    @foreach($question->answers as $answer)
                                        <div class="flex items-center">
                                            @php
                                                $trys = $user->questionAnswers()->where('slug',$answer->slug)->get();
                                            @endphp
                                            <input id="{{$answer->slug}}" value="{{$answer->slug}}" name="{{$question->slug}}" @checked(count($trys)>0) type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="{{$answer->slug}}" class="pointer-events-none ml-3 mr-3 block text-sm font-medium text-gray-700">{{$answer->answer}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </fieldset>
                        </div>
                    @endforeach
                    <div class="p-6 mb-10 sm:px-20 bg-white border-b border-gray-200 text-center">
                        <input type="submit"
                               class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" value="Siguiente">
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

