<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('従業員作成') }}
        </h2>
    </x-slot>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route ('employee.store')}}" method="POST">
            @csrf
            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">企業一覧</label>
            <select id="countries" name="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>所属企業を選択してください</option>
            @foreach ( $companies as $company )
                <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
            </select>
            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">従業員名</label>
                <div class="mt-2">
                <input id="email" name="name" type="text" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>

            <div>
            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">登録</button>
                <a href="{{route('employee')}}" class="text-black mt-8 flex w-full justify-center rounded-md px-3 py-1.5 text-sm font-semibold leading-6 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">戻る</a>
            </div>
            </form>
        </div>
    </div>
</x-app-layout>
