@props(['for'])

@error($for)
    <span {{ $attributes->merge(['class' => 'text-xs text-red-500 mt-1 block']) }}>
        {{ $message }}
    </span>
@enderror
