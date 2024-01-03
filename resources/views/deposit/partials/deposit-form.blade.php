<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Deposit Money') }}
        </h2>
    </header>

    <form method="post" action="{{ route('deposit.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="deposit_amount" :value="__('Amount')" />
            <x-text-input id="deposit_amount" name="amount" type="number" class="mt-1 block w-full" autocomplete="deposit-amount" />
        </div>




        <div class="flex items-center gap-6">
            <x-primary-button style="width: 100%; display: flex; justify-content: center;">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'deposit-amount')
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
