<x-app-layout>
    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sm:border-r">
                <div class="p-6 text-gray-900">
                   Wellcome {{ Auth::user()->name }}
                    <br>
                   Balance Wellcome {{ Auth::user()->accounts->balance }}
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
