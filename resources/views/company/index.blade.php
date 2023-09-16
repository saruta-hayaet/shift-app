<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('企業一覧') }}
        </h2>
    </x-slot>

    <div class="board">
        <div class="flex flex-col table">
            <div class="-m-1.5 overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                  <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">会社ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">会社名</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ( $companies as $company)
                          <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $company->id}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $company->name}}</td>
                            <td  class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 text-blue-500">
                                <form action="{{ route('company.edit', ['id'=>$company->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">編集</button>
                                </form>
                            </td>
                            <td  class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200 text-red-600">
                                <form action="{{ route('company.destroy', ['id'=>$company->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">削除</button>
                                </form>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>

        <a href="{{ route ('company.create')}}" type="button" class="button bg-indigo-600">新規登録</a>
    </div>


</x-app-layout>
