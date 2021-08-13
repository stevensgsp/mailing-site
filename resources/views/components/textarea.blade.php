@props(['disabled' => false])
@props(['errors'])

@php
$extraClass = $errors->has($attributes->get('name')) ? 'border-red-500' : '';
$extraClass .= $disabled ? ' text-gray-300' : '';
@endphp

<textarea
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300
                    focus:ring focus:ring-indigo-200 focus:ring-opacity-50 ' . $extraClass
    ]) !!}
>{{ $content }}</textarea>

@if ($errors->has($attributes->get('name')))
    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
        {{ $errors->first($attributes->get('name')) }}
    </span>
@endif
