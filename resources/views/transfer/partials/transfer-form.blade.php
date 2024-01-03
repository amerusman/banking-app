<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Transfer Money') }}
        </h2>
    </header>

    <form method="post" action="{{ route('transfer.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" autocomplete="email" />

        </div>

        <div>
            <x-input-label for="amount" :value="__('Amount')" />
            <x-text-input id="transfer_amount" name="amount" type="number" class="mt-1 block w-full" autocomplete="transfer-amount" />

        </div>




        <div class="flex items-center gap-6">
            <x-primary-button style="width: 100%; display: flex; justify-content: center;">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'transfer-amount')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
