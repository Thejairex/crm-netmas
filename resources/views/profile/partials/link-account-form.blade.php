<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Vincular Cuenta') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Vincule su cuenta con otra cuenta.') }}
        </p>
    </header>

    <!-- seccion para mostrar las cuentas vinculadas -->
    @if ($linkedAccounts->count() > 0)
    <div>
        <div class="mt-6">
            <h3 class="text-lg font-medium text-gray-900">
                {{ __('Cuentas Vinculadas') }}
            </h3>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Estas son las cuentas vinculadas a tu cuenta.') }}
            </p>

            @foreach ($linkedAccounts as $linkedAccount)
            <div class="mt-6">
                <p class="text-sm text-gray-600">
                    {{ $linkedAccount['name'] }} {{ $linkedAccount['lastname'] }}
                </p>

                <p class="text-sm text-gray-600">
                    {{ $linkedAccount['email'] }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'link-account-modal')">{{ __('Vincular Cuenta') }}</x-danger-button>

    <x-modal name="link-account-modal" :show="$errors->userDeletion->count() > 0" focusable>
        <form method="post" action="/link-account" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Vincular Cuenta') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Vincule su cuenta con otra cuenta.') }}
            </p>


            <div class="mt-6">
                <x-input-label for="linked_user_email" :value="__('Email')" />
                <x-text-input id="linked_user_email" class="block mt-1 w-full" type="email" name="linked_user_email" :value="old('linked_user_email')" required autocomplete="linked_user_email" />
                <x-input-error :messages="$errors->get('linked_user_email')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Vincular Cuenta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>

</section>