@props([
    'title' => 'Submit',
    'variant' => 'primary',
    'type' => 'submit',
    'position' => 'end',
])

<div class="col-12 text-{{ $position }}">
    <button type="{{ $type }}" class="btn btn-{{ $variant }}">
        {{ $title }}
    </button>
</div>
