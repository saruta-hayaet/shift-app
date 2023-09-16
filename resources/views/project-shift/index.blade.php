<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('案件シフト一覧') }}
        </h2>
    </x-slot>

    <form class="p-s-form" action="{{ route('project-shift.show') }}" method="POST">
        @csrf

        <select name="select" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option hidden value="">案件を選択</option>
        @foreach ($projects as $project)
        <option value="{{$project->id}}">{{$project->title}}</option>
        @endforeach
        </select>

        <select required name="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option hidden value="">月を選択</option>
        @for ($i = 1; $i <= 12; $i++)
        <option value="{{ $i }}月">{{ $i }}月</option>
        @endfor
        </select>

        <button type="submit">検索する</button>
    </form>

</x-app-layout>
