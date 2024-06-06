@php
    use Carbon\Carbon;
@endphp

<div>
    @if(in_array('create', $actions))
    <div class="flex justify-end py-4">
        <button wire:click="create" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Create</button>
    </div>
    @endif
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    @foreach ($collumns as $collumn)
                        <th scope="col" class="px-6 py-3">
                            {{ $collumn }}
                        </th>
                    @endforeach

                    @isset($actions)
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($links as $item)
                <tr class="border-b odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
                    @foreach (json_decode($item, true) as $key => $value)
                        <td class="px-6 py-4">
                            @if (strtotime($value)) <!-- Check if the value is a valid date/time string -->
                                {{ Carbon::parse($value)->format('Y-m-d H:i:s') }}
                            @else
                                {{ $value }}
                            @endif
                        </td>
                    @endforeach

                    @isset($actions)
                        <td class="py-4">
                            @if(in_array('edit', $actions))
                                <button wire:click="edit({{ $item->id }})" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
                            @endif

                            @if(in_array('delete', $actions))
                                <button wire:click="delete('{{ $item->id }}')" type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                            @endif

                            @if(in_array('search', $actions))
                            <a href="{{ $item->redirect_from }}" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">
                                Search
                            </a>
                        @endif
                        </td>
                    @endif
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
