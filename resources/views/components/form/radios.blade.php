@props([
'name' => '',
'label' => '',
'options' => [],
'value' => '',
'id' => uniqid(),
'required' => false,
'col' => 'col-lg-6',
'class' => '',
'checked' => 'active',
'labelColumn' => 'col-md-3',
'inputColumn' => 'col-md-6',
])


<div class="{{ $col }} input-component mb-2">
    <label for="{{ $id }}" class="form-label fw-bold">
        {{ $label }} @if($required) <span class="text-danger">*</span> @endif
    </label>
    <div class="d-flex justify-content-between mt-1">
        @foreach($options as $option)
            <div class="form-check">
                <input class="form-check-input" @if(strtolower($checked) == strtolower($option)) checked @endif type="radio" name="{{$name}}" id="{{ strtolower($option) }}" value="{{ strtolower($option) }}">
                <label class="form-check-label" for="{{ strtolower($option) }}">
                    {{ translate($option) }}
                </label>
            </div>
        @endforeach
    </div>
    {{ $slot }}
    @error($name)
    <span class="text-danger"><i class="fas fa-warning"></i> {{ $message }}</span>
    @enderror
</div>


