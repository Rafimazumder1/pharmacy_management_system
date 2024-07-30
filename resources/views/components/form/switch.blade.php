@props([
'name' => '',
'label' => '',
'value' =>  '',
'required' => false,
'col' => 'col-lg-6',
'class' => '',
])

<div class="input-component {{ $col }}">
    <div class="form-check form-switch">
        <input type="hidden" name="{{ $name }}" value="0">
        <input
            name="{{ $name }}"
            class="form-check-input {{ $class }}"
            type="checkbox"
            role="switch"
            value="1"
            @if($value) checked @endif
            id="{{$name.'-switch'}}"
        >
        {{ $slot }}
        <label class="form-check-label" for="{{$name.'-switch'}}">
            {{ translate($label) }} @if($required) <span class="text-danger">*</span> @endif
        </label>
    </div>
    @error($name)
        <span class="text-danger"><i class="fas fa-warning"></i> {{ $message }}</span>
    @enderror
</div>

