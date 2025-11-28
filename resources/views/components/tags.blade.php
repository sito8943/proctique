<ul class="flex flex-wrap @if ($orientation == 'vertical') flex-col @else items-center justify-start @endif gap-2">
    @if ($tags->count() > 0)
        @foreach ($tags as $tag)
            @php
                $isActive = empty($admin) && (int) request('tag') === (int) $tag->id;
            @endphp
            <li>
                <a href="{{ $admin ? route('admin.tags.edit',$tag->id) :  url('/projects?tag=' . $tag->id) }}"
                   style=" --tag-color: {{ $tag->color }};"
                   @if($isActive) aria-current="true" @endif
                   class="group inline-flex items-center rounded px-2 py-1 text-xs border transition-colors
                          {{ $isActive ? 'bg-[var(--tag-color)]/20 border-[var(--tag-color)] text-[var(--tag-color)] font-semibold' : 'border-gray-300 hover:bg-[var(--tag-color)]/20 hover:border-[var(--tag-color)] hover:text-[var(--tag-color)]' }}">
                    <span class="text-[var(--tag-color)] mr-1">#</span>{{ $tag->name }}
                </a>
            </li>
        @endforeach
    @else
        <p class="text-xs italic text-gray-400">
            No tags
        </p>
    @endif

</ul>
