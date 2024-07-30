@props([
'name' => '',
'label' => '',
'id' => rand(1, 9),
'placeholder' => 'Enter here',
'value' => '',
'required' => false,
'col' => 'col-lg-12',
'class' => 'form-control',
'rows' => '3',
])

<div class="{{ $col }} input-component mb-2">
    <label for="{{ $id }}" class="form-label fw-bold">
        {{ translate($label) }} @if($required) <span class="text-danger">*</span> @endif
    </label>
    <textarea
        rows="{{ $rows }}"
        id="{{ $id }}"
        placeholder="{{ translate($placeholder) }}"
        class="text-dark {{ $class }}"
        name="{{ $name }}"
    >{!! $value !!}</textarea>
    @error($name)
    <span class="text-danger"><i class="fas fa-warning"></i> {{ $message }}</span>
    @enderror
</div>
