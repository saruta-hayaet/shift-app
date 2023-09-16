
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('シフト一覧') }}
        </h2>
    </x-slot>

    <div class="table-wrap">
        <a href="{{route('shift.create')}}" class="link flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">シフトを作成</a>
        {{-- <a href="{{route('shift.edit')}}" class="link flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">シフトを編集</a> --}}
        <div class="table-wrap-inner">
            <table class="table-main">
                <thead class="">
                    <tr class="t-head-tr">
                        <th class="common-width">担当者</th>
                        @foreach ($dates as $date)
                            <th class="common-width">{{ $date->format('n月j日') }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="tbody divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($employees as $employee)
                    <tr class="tbody-tr">
                        <td class="common-width">{{ $employee->name }}</td>
                        @foreach ($dates as $date)
                        @php
                            // 特定の従業員と日付の組み合わせでシフトを探します。
                            $employeeShift = $shifts->first(function($shift) use ($employee, $date) {
                                return $shift->employee_id == $employee->id && $shift->shift_date == $date->format('Y-m-d');
                            });
                        @endphp
                        <td class="tbody-tr-td common-width">
                            <p class="project">{{ $employeeShift && $employeeShift->morningProject ? $employeeShift->morningProject->title : '' }}</p>
                            <p class="project">{{ $employeeShift && $employeeShift->afternoonProject ? $employeeShift->afternoonProject->title : '' }}</p>
                        </td>
                    @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>


