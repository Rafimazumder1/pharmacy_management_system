@props([
'name' => '',
'label' => '',
'id' => uniqid(),
'type' => 'text',
'placeholder' => 'Enter here',
'option_label' => '--Choose--',
'required' => false,
'col' => 'col-lg-6',
'class' => 'form-select',
])

<div class="{{ $col }} input-component mb-2">
    <label for="{{ $id }}" class="form-label fw-bold">
        {{ translate($label) }} @if($required) <span class="text-danger">*</span> @endif
    </label>
    <select name="{{ $name }}" id="{{ $id }}" class="{{ $class }}">
        <option value="">{{ $option_label }}</option>
        {{ $slot }}
    </select>

    @error($name)
        <span class="text-danger"><i class="fas fa-warning"></i> {{ $message }}</span>
    @enderror
</div>
