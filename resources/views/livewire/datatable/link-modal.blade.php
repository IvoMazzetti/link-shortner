@if ($this->showModal)
  <!-- Main modal -->
  <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-gray-800 bg-opacity-50">
    <div class="max-h-full p-4 bg-white rounded shadow-lg">
              <div class="relative w-full max-w-md max-h-full p-4">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Lets create a new link
                  </h3>
                  <button type="button" wire:click="$set('showModal', false)" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5">
                  <form class="space-y-4" wire:submit.prevent="save">
                      <div>
                        <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Redirect Link</label>
                        <input wire:model='originalLink' type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="https://www.example.com"/>
                          @error('originalLink') <span class="text-sm text-red-700 error">{{ $message }}</span> @enderror
                        </div>
                      <div x-data="{ redirectString: @entangle('redirectString') }">
                          <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shortned Value</label>
                          <input  wire:model.live='redirectString' type="text" name="password" id="password" placeholder="FnKpXc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  />
                          @error('redirectString') <span class="text-sm text-red-700 error">{{ $message }}</span> @enderror
                    </div>

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
  </div>
  </div>


  @endif
