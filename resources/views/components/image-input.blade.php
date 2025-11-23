@php($inputId = $id !== '' ? $id : $name)
@php($removeName = $name . '_remove')
<div class="flex flex-col gap-2 w-full">
    <label for="{{ $inputId }}" class="font-medium">{{ $label }}

    </label>

    <input class="hidden" id="{{ $inputId }}" type="file" name="{{ $name }}" accept="{{ $accept }}" />
    <input type="hidden" name="{{ $removeName }}" id="{{ $inputId }}_remove" value="0" />

    <label for="{{ $inputId }}"
        class="relative border-2 border-dashed rounded-lg w-full aspect-video flex items-center justify-center cursor-pointer bg-white/40 hover:bg-white transition group overflow-hidden">
        <div id="{{ $inputId }}_placeholder"
            class="pointer-events-none flex flex-col items-center justify-center transition absolute inset-0 {{ empty($preview) ? 'text-gray-500 group-hover:text-red-400' : 'opacity-0 group-hover:opacity-100 text-white bg-black/30' }}">
            <x-fas-plus class="w-8 h-8 mb-2" />
            <span>{{ empty($preview) ? 'Click to upload' : 'Click to change' }}</span>
        </div>

        <img id="{{ $inputId }}_preview" alt="Preview"
            class="object-cover w-full h-full @if (empty($preview)) hidden @endif" src="{{ $preview }}" />

        <button type="button" id="{{ $inputId }}_clear"
            class="absolute top-2 right-2 inline-flex items-center justify-center w-9 h-9 rounded-full border border-red-500 bg-white text-red-500 hover:bg-red-500 hover:text-white transition shadow @if (empty($preview)) hidden @endif"
            title="Remove image"
            aria-label="Remove image">
            <x-fas-trash class="w-4 h-4" />
        </button>
    </label>

    @error($name)
        <p class="text-red-400">{{ $message }}</p>
    @enderror

    <script>
        (function () {
            const input = document.getElementById('{{ $inputId }}');
            const img = document.getElementById('{{ $inputId }}_preview');
            const placeholder = document.getElementById('{{ $inputId }}_placeholder');
            const clearBtn = document.getElementById('{{ $inputId }}_clear');
            const removeField = document.getElementById('{{ $inputId }}_remove');
            if (!input || !img || !placeholder || !clearBtn || !removeField) return;

            input.addEventListener('change', function (event) {
                const file = event.target.files && event.target.files[0];
                const span = placeholder.querySelector('span');
                if (file) {
                    img.src = URL.createObjectURL(file);
                    img.classList.remove('hidden');
                    // Show overlay text on hover when an image is present
                    placeholder.classList.remove('hidden');
                    placeholder.classList.add('opacity-0');
                    placeholder.classList.add('text-white', 'bg-black/30', 'group-hover:opacity-100');
                    placeholder.classList.remove('text-gray-500', 'group-hover:text-red-400');
                    if (span) span.textContent = 'Click to change';
                    clearBtn.classList.remove('hidden');
                    removeField.value = '0';
                } else {
                    img.src = '';
                    img.classList.add('hidden');
                    placeholder.classList.remove('opacity-0', 'text-white', 'bg-black/30', 'group-hover:opacity-100');
                    placeholder.classList.add('text-gray-500', 'group-hover:text-red-400');
                    if (span) span.textContent = 'Click to upload';
                    clearBtn.classList.add('hidden');
                }
            });

            clearBtn.addEventListener('click', function (event) {
                event.preventDefault();
                // Clear the file input
                input.value = '';
                // Hide image and show placeholder fully
                img.src = '';
                img.classList.add('hidden');
                const span = placeholder.querySelector('span');
                placeholder.classList.remove('opacity-0', 'text-white', 'bg-black/30', 'group-hover:opacity-100');
                placeholder.classList.add('text-gray-500', 'group-hover:text-red-400');
                if (span) span.textContent = 'Click to upload';
                clearBtn.classList.add('hidden');
                // Mark for server-side removal
                removeField.value = '1';
            });
        })();
    </script>
</div>
