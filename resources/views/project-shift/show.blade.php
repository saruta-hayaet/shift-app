<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('案件シフト一覧') }}
        </h2>
    </x-slot>


    @if ($dataExists)
    <a class="p-s-back" href="{{ route('project-shift') }}">検索に戻る</a>
    <form action="{{ route('csv') }}" method="POST">
        @csrf
        @foreach ($datesWithDayNames as $csvitem)
            <?php
            $csvdate = \Carbon\Carbon::parse($csvitem['date']);
            $csvdate->setLocale('ja'); // 日本語のロケールを設定
            $csvformattedDate = $csvdate->format('n月j日') . $csvdate->isoFormat('ddd');
            $csvDate[] = $csvformattedDate;
            ?>
            @foreach ($shifts as $shift )
                @if ($csvitem['date'] == $shift->shift_date)
                    <?php $csvemployeeNames[] = $shift->employee->name;?>
                @endif
            @endforeach
        @endforeach


        @foreach($csvemployeeNames as $index => $name)
            <input type="hidden" name="csvemployeeNames[]" value="{{ $name }}">
        @endforeach

        @foreach($csvDate as $index => $date)
        <input type="hidden" name="csvDate[]" value="{{ $date }}">
        @endforeach

        <input type="hidden" name="projectName" value="{{ $projectName }}">
        <button type="submit" class="csv-button">csvファイルをダウンロード</button>
    </form>
    <div class="p-s-table">
        <div class="p-s-thead">
            <div class="p-s-thead-inner">
                <p class="txt-left">日付</p>
                <p>担当者</p>
            </div>
        </div>
        <div class="p-s-body-wrap">
            @foreach ($datesWithDayNames as $item)
                <?php
                $date = \Carbon\Carbon::parse($item['date']);
                $date->setLocale('ja'); // 日本語のロケールを設定
                $formattedDate = $date->format('n月j日') . $date->isoFormat('ddd');
                ?>
                <div class="p-s-body">
                    <p class="txt-left">{{ $date->format('n月j日') }}{{ $date->isoFormat('ddd') }}</p>
                    @foreach ($shifts as $shift )
                        @if ($item['date'] == $shift->shift_date)
                            <p>{{$shift->employee->name}}</p>
                            <?php $employeeNames[] = $shift->employee->name;?>
                        @endif
                    @endforeach
                </div>
            @endforeach
            </div>
        </div>
    @else
        <p>条件に一致するシフトが見つかりませんでした。</p>
    @endif



</x-app-layout>
