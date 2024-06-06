    <div class="relative w-full max-w-md max-h-full p-4">
        <div class="relative bg-white rounded-lg dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Let's create a new link
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" wire:submit.prevent="save">
                    <div>
                        <label for="originalLink" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Redirect Link</label>
                        <input wire:model='originalLink' type="text" id="originalLink" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="https://www.example.com"/>
                        @error('originalLink') <span class="text-sm text-red-700 error">{{ $message }}</span> @enderror
                    </div>
                    <div x-data="{ redirectString: @entangle('redirectString') }">
                        <label for="redirectString" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shortened Value</label>
                        <input wire:model='redirectString' type="text" id="redirectString" placeholder="FnKpXc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"/>
                        @error('redirectString') <span class="text-sm text-red-700 error">{{ $message }}</span> @enderror
                    </div>
                    <span class="text-sm text-gray-500">If you want to login  <a href="{{ route('login') }}" class="text-blue-500">click here</a></span>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Generate Link</button>

                    @if($redirectString)
                        <div class="mt-10 text-sm">
                            <p class="text-black">Your final link should look like:</p>
                            <a href="{{ env('APP_URL') }}/redirect/{{ $redirectString }}">
                                <p class="font-bold text-gray-600 text-md">{{ env('APP_URL') }}/redirect/{{ $redirectString }}</p>
                            </a>

                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
