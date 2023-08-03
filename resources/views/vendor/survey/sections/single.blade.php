<h3 class="px-4 py-2 text-bold text-xl bg-slate-600 text-white">{{ $section->name }}</h3>
@foreach($section->questions as $question)
    @include('survey::questions.single')
@endforeach