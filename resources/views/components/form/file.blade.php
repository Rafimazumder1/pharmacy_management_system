@props([
'name' => '',
'label' => '',
'id' => uniqid(),
'value' => '',
'required' => false,
'col' => 'col-lg-6',
'class' => '',
])

<div class="{{ $col }} input-component mb-2">
    <label for="{{ $id }}" class="form-label fw-bold">
        {{ translate($label) }} @if($required) <span class="text-danger">*</span> @endif
    </label>
    <div class="d-flex gap-1 align-content-center">
        <div class="preview-image">
            @if(!empty($value))
                <img src="{{ asset('storage/'.$value) }}" id="previewImage" class="rounded-3" height="40" width="40" alt="">
            @else
                <img src="{{ asset('assets/img/no-image.png') }}" id="previewImage" class="rounded-3" height="40" width="40" alt="">
            @endif
        </div>
        <input
            accept="image/*"
            onchange="previewImage()"
            type="file"
            id="imageInput"
            class="form-control {{ $class }}"
            name="{{ $name }}"
        >
    </div>
    {{ $slot }}
    @error($name)
    <span class="text-danger"><i class="fas fa-warning"></i> {{ $message }}</span>
    @enderror
</div>

<script>
    function previewImage() {
        var input = document.getElementById('imageInput');
        var preview = document.getElementById('imagePreview');

        var file = input.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        }

        reader.readAsDataURL(file);
    }
</script>
