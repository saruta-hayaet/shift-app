<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('シフト編集') }}
        </h2>
    </x-slot>

    <form action="{{ route('shift.update') }}" method="POST">
        @csrf

        <table class="s-c-table min-w-full divide-y mt-20 mb-20 divide-gray-200 dark:divide-gray-700">
            <thead class="s-c-thead">
                <tr>
                    <th class="s-c-left">担当者</th>
                    @foreach ($dates as $date)
                        <th>{{ $date->format('n月j日') }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($employees as $employee)
                <tr class="s-c-tr">
                    <td class="s-c-left" style="width: 100px;">{{ $employee->name }}</td>
                    @foreach ($dates as $index => $date)
                    <td>
                        <select class="s-c-select" name="morning_shift[{{ $employee->id }}][{{ $index }}]" class="form-selec">
                            <option value="">午前</option>
                            @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                            @endforeach
                        </select>
                        <select class="s-c-select" name="afternoon_shift[{{ $employee->id }}][{{ $index }}]" class="form-selec mt-2">
                            <option value="">午後</option>
                            @foreach ($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">更新</button>
    </form>


</x-app-layout>
