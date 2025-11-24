<div class="mb-4">
    <label for="tags">Tags</label>
    <fieldset class="flex gap-2 flex-wrap mt-4">
        @foreach($options as $key => $label)
            <div>
                <input type="checkbox" name="tags[]" value="{{$key}}" @if(in_array($key, old('tags', $values))) checked
                @endif />
                <label>{{$label}}</label>
            </div>
        @endforeach
    </fieldset>
    @error('tags')
        <p class="text-red-400">{{ $message }}</p>
    @enderror
</div>