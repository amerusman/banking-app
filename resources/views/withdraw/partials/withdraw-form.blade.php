<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('WithDraw Money') }}
        </h2>
    </header>

    <form method="post" action="{{ route('withdraw.store') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="amount" :value="__('Amount')" />
            <x-text-input id="withdraw_amount" name="amount" type="number" class="mt-1 block w-full" autocomplete="withdraw.amount" />

        </div>




        <div class="flex items-center gap-6">
            <x-primary-button style="width: 100%; display: flex; justify-content: center;">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'withdraw.amount')
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
