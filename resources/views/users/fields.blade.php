<!-- nombre -->
<div class="mb-3">
    <x-label for="name" :value="__('Name')" />
    <x-input
        id="name"
        class="block mt-1 w-full"
        type="text"
        name="name"
        :value="old('name', $user->name ?? null)"
        required
        autofocus
        :disabled="@$disabled"
    />
</div>

<!-- email -->
<div class="mb-3">
    <x-label for="email" :value="__('E-mail')" />
    <x-input
        id="email"
        class="block mt-1 w-full"
        type="text"
        name="email"
        :value="old('email', $user->email ?? null)"
        required
        :disabled="request()->routeIs('users.edit') || @$disabled"
    />
</div>

@if (! @$disabled)
    <!-- password -->
    <div class="mb-3">
        <x-label for="password" :value="__('Password')" />
        <x-input
            id="password"
            class="block mt-1 w-full"
            type="password"
            name="password"
        />
    </div>

    <!-- password_confirmation -->
    <div class="mb-3">
        <x-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-input
            id="password_confirmation"
            class="block mt-1 w-full"
            type="password"
            name="password_confirmation"
        />
    </div>
@endif

<!-- phone_number -->
<div class="mb-3">
    <x-label for="phone_number" :value="__('Phone Number')" />
    <x-input
        id="phone_number"
        class="block mt-1 w-full"
        type="number"
        name="phone_number"
        :value="old('phone_number', $user->phone_number ?? null)"
        :disabled="@$disabled"
    />
</div>

<!-- cedula -->
<div class="mb-3">
    <x-label for="cedula" :value="__('Cedula')" />
    <x-input
        id="cedula"
        class="block mt-1 w-full"
        type="number"
        name="cedula"
        :value="old('cedula', $user->cedula ?? null)"
        :disabled="request()->routeIs('users.edit') || @$disabled"
    />
</div>

<!-- birth_date -->
<div class="mb-3">
    <x-label for="birth_date" :value="__('Birth Date')" />
    <x-input
        id="birth_date"
        class="block mt-1 w-full"
        type="date"
        name="birth_date"
        :value="old('birth_date', $user->formatted_birth_date ?? null)"
        :disabled="@$disabled"
    />
</div>

<!-- country -->
<div class="mb-3">
    <x-label for="country" :value="__('Country')" />
    <x-select id="country" class="block mt-1 w-full" name="country" onchange="changeCountry(event.target.value)" :disabled="@$disabled">
        <x-slot name="options">
            <option value="0">Select</option>

            @foreach ($countries as $country)
                <option value="{{ $country->id }}"
                    {{ old('country', $user->city->state->country->id ?? null) === $country->id ? 'selected' : '' }}
                >
                    {{ $country->name }}
                </option>
            @endforeach
        </x-slot>
    </x-select>
</div>

<!-- state -->
<div class="mb-3">
    <x-label for="state" :value="__('State')" />
    <x-select id="state" class="block mt-1 w-full" name="state" onchange="changeState(event.target.value)" :disabled="@$disabled">
        <x-slot name="options">
            <option value="0" selected disabled>Select</option>

            @foreach ($states ?? [] as $state)
                <option value="{{ $state->id }}"
                    {{ old('state', $user->city->state->id ?? null) === $state->id ? 'selected' : '' }}
                >
                    {{ $state->name }}
                </option>
            @endforeach
        </x-slot>
    </x-select>
</div>

<!-- city_id -->
<div class="mb-3">
    <x-label for="city_id" :value="__('City')" />
    <x-select id="city_id" class="block mt-1 w-full" name="city_id" :disabled="@$disabled">
        <x-slot name="options">
            <option value="0" selected disabled>Select</option>

            @foreach ($cities ?? [] as $city)
                <option value="{{ $city->id }}"
                    {{ old('city_id', $user->city->id ?? null) === $city->id ? 'selected' : '' }}
                >
                    {{ $city->name }}
                </option>
            @endforeach
        </x-slot>
    </x-select>
</div>

<!-- back button -->
@if (! @$disabled)
    <a href="{{ route( 'users.index' ) }}">
        <x-button class="ml-0 bg-gray-100" type="button">
            {{ __('Back') }}
        </x-button>
    </a>
@endif

<!-- save button -->
@if (@$disabled !== 'disabled')
    <x-button class="ml-3 bg-green-500" type="submit">
        {{ __('Save') }}
    </x-button>
@endif

@push('scripts')
<script>
    // no tengo axios :(
    const axios = (method, path, data, myCallback) => {
        const xhttp = new XMLHttpRequest()
        xhttp.open(method, path, true)
        xhttp.setRequestHeader('Content-Type', 'application/json')
        xhttp.setRequestHeader('Authorization', 'Bearer {{Auth::user()->api_token}}')
        xhttp.onreadystatechange = myCallback(xhttp);
        xhttp.send(JSON.stringify(data))
    }

    const changeCountry = (countryId) => {
        const myCallback = (xhttp) => () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                const data = JSON.parse(xhttp.response).data;
                const sel = document.getElementById('state');
                sel.innerHTML = '';

                const selCity = document.getElementById('city_id');
                selCity.innerHTML = '<option value="0" selected disabled>Select</option>';

                let options = '<option value="0" selected disabled>Select</option>';
                for (let i=0; i<data.length; i++) {
                    let optionValue = data[i].id;
                    let optionContent = `${data[i].name}`;

                    options += `<option value="${optionValue}"
                        ${ '{{ old('state', $user->city->state->id ?? null) }}' == optionValue ? 'selected' : '' }
                    >
                        ${optionContent}
                    </option>`;

                    if ('{{ old('state', $user->city->state->id ?? null) }}' == optionValue) {
                        changeState(optionValue);
                    }
                }

                sel.innerHTML = options;
            }
        };

        axios('GET', `{{ route('statesByCountry') }}/${countryId}`, {}, myCallback)
    }

    const changeState = (stateId) => {
        const myCallback = (xhttp) => () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                const data = JSON.parse(xhttp.response).data;
                const sel = document.getElementById('city_id');

                sel.innerHTML = '';

                let options = '<option value="0" selected disabled>Select</option>';
                for (let i=0; i<data.length; i++) {
                    let optionValue = data[i].id;
                    let optionContent = `${data[i].name}`;

                    options += `<option value="${optionValue}"
                        ${ '{{ old('city_id', $user->city->id ?? null) }}' == optionValue ? 'selected' : '' }
                    >
                        ${optionContent}
                    </option>`;
                }

                sel.innerHTML = options;
            }
        };

        axios('GET', `{{ route('citiesByState') }}/${stateId}`, {}, myCallback)
    }

    @if (! is_null($countryId = old('country', $user->city->state->country->id ?? null)))
        changeCountry('{{ $countryId }}');
    @endif
</script>
@endpush