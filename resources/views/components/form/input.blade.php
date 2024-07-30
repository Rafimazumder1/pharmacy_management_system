@props([
'name' => '',
'label' => '',
'id' => uniqid(),
'type' => 'text',
'placeholder' => 'Enter here',
'value' => '',
'required' => false,
'col' => 'col-lg-6',
'class' => '',
])

<div class="{{ $col }} input-component mb-2">
    <label for="{{ $id }}" class="form-label fw-bold">
        {{ translate($label) }} @if($required) <span class="text-danger">*</span> @endif
    </label>
    <input
            type="{{ $type }}"
            id="{{ $id }}"
            placeholder="{{ translate($placeholder) }}"
            class="form-control {{ $class }}"
            value="{{ $value }}"
            name="{{ $name }}"
    >
    {{ $slot }}
    @error($name)
        <span class="text-danger"><i class="fas fa-warning"></i> {{ $message }}</span>
    @enderror
</div>
