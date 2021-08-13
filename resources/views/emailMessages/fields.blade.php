<!-- to -->
<div class="mb-3">
    <x-label for="to" :value="__('To')" />
    <x-input
        id="to"
        class="block mt-1 w-full"
        type="email"
        name="to"
        :value="old('to', $emailMessage->to ?? null)"
        required
        autofocus
        :disabled="request()->routeIs('emailMessages.show') || @$disabled"
    />
</div>

<!-- subject -->
<div class="mb-3">
    <x-label for="subject" :value="__('Subject')" />
    <x-input
        id="subject"
        class="block mt-1 w-full"
        type="text"
        name="subject"
        :value="old('subject', $emailMessage->subject ?? null)"
        required
        :disabled="@$disabled"
    />
</div>

<!-- body -->
<div class="mb-3">
    <x-label for="body" :value="__('Body')" />
    <x-textarea
        id="body"
        class="block mt-1 w-full"
        name="body"
        required
        :disabled="@$disabled"
    ><x-slot name="content">{{ old('body', $emailMessage->body ?? null) }}</x-slot></x-textarea>
</div>

<!-- back button -->
<a href="{{ route( 'emailMessages.index' ) }}">
    <x-button class="ml-0 bg-gray-100" type="button">
        {{ __('Back') }}
    </x-button>
</a>

<!-- save button -->
@if (@$disabled !== 'disabled')
    <x-button class="ml-3 bg-green-500" type="submit">
        {{ __('Save') }}
    </x-button>
@endif
