<div class="p-14">
    <div class="flex justify-between">

        <div class="py-4">
            <h1 class="px-4 text-3xl font-bold">Manage Links</h1>
            <p class="px-4 text-gray-500 text-md">Here you will be able to edit, delete and create links</p>
        </div>
    </div>

    @include('livewire.datatable.table')
    @include('livewire.datatable.link-modal')

</div>
