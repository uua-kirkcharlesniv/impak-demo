<div>
    <form wire:submit.prevent="save">
        <header class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
            <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                <span>Select your spreadsheet file for uploading</span>
            </p>
            <input wire:model="file" type="file"
                class="mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none" />

            <br>
            <span class="text-gray-500 text-sm">Maximum size of 3MB</span>
            <span class="text-gray-500 text-sm">Accepted files are only: .xlsx, .xls, .csv</span>

            @error('file')
                <span class="text-red-500 my-2">{{ $message }}</span>
            @enderror

            @if (isset($fileErrors) && count($fileErrors) > 0)
                <ul>
                    @foreach ($fileErrors as $error)
                        <li><span class="text-red-500 my-2">{{ $error }}</span></li>
                    @endforeach
                </ul>
            @endif

            <button type="submit" class="btn-lg bg-indigo-500 hover:bg-indigo-600 text-white mt-5">Process
                File</button>
        </header>
    </form>
</div>
