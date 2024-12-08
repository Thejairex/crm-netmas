<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Estado de Verificación') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
        {{ __('Usuario: ') }} {{ auth()->user()->name }}
        </p>
    </header>

    @if(auth()->user()->kyc_status === 'approved')
        <p class="text-green-600">Tu verificación ha sido aprobada.</p>
    @elseif(auth()->user()->kyc_status === 'pending')
        <p class="text-yellow-600">Tu verificación está en proceso.</p>
    @elseif(auth()->user()->kyc_status === 'rejected')
        <p class="text-red-600">Tu verificación fue rechazada. Por favor, intenta nuevamente.</p>
    @else
        <p class="text-gray-600">Aún no has enviado tu verificación de identidad.</p>
        <a href="/profile/verification" class="text-blue-600">Iniciar Verificación</a>
    @endif
</section>