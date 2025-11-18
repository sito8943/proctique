<div class="flex flex-col gap-4 items-start justify-start w-full">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea id={ {$id }} name={{ $name }} @class([
        'border-2 rounded-xl px-4 py-1 resize-none w-full',
        'border-red-400' => $errors->has($name),
        'border-gray-200' => !$errors->has($name),
    ]) rows={{ $rows }}
        placeholder={{ $placeholder }}>{{ $value }}</textarea>
    @error($name)
        <p class="text-red-400">{{ $message }}</p>
    @enderror
</div>