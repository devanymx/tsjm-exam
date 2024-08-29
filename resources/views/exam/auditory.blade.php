<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200" style="padding-bottom: 1rem;">
                Examen correspondiente a: {{$user->name}}
            </div>
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200" style="padding-bottom: 1rem;">
                @php
                    \Carbon\Carbon::setUTF8(true);
                    \Carbon\Carbon::setLocale(config('app.locale'));
                    setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
                            $date = new \Carbon\Carbon($exam->finished_at);
                            $formatedDate = $date->isoFormat('MMMM Do YYYY, h:mm:ss a');
                @endphp
                Con fecha de finalización en: {{$formatedDate}}
            </div>
            <div class="w-100" style="padding-bottom:1rem;">
                Teniendo una duración de resolución de: {{$exam->time}}
            </div>
            @foreach($questions as $question)
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <label class="text-base font-medium text-gray-900">
                        <span class="text-xl font-bold">{{($loop->iteration)}}.- </span>{{$question->question}}
                    </label>
                    <fieldset class="mt-4">
                        <legend class="sr-only">Notification method</legend>
                        <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                            @foreach($question->answers as $answer)
                                <div class="flex items-center">
                                    @php
                                        $trys = $user->questionAnswers()->where('question_answers.id',$answer->id)->get();
                                    @endphp
                                    <input id="{{$answer->id}}" value="{{$answer->id}}" name="{{$question->id}}" @checked(count($trys)>0) type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="{{$answer->id}}" class="pointer-events-none ml-3 mr-3 block text-sm font-medium text-gray-700">{{$answer->answer}}</label>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                </div>
            @endforeach
        </div>
    </div>
</div>
