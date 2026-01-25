<?php

use Livewire\Component;

use Illuminate\Support\Str;

use App\Models\Project;
use App\Models\Review;

new class extends Component {
    public Project $project;
    public string $comment = '';
    public int $stars = 5;
    public bool $successful = false;

    public function addComment()
    {
        $this->validate([
            'stars' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:255'],
        ]);

        Review::create([
            'author_id' => auth()->id(),
            'project_id' => $this->project->id,
            'stars' => $this->stars,
            'comment' => $this->comment ?? null,
        ]);

        $this->comment = '';
        $this->stars = 5;
        $this->successful = true;

        $this->dispatch('review-added');
    }
};
?>

<div>
    @auth
        @if (auth()->id() !== $project->author_id)
            <form wire:submit="addComment()" class="flex flex-col gap-3 border border-slate-200 rounded-lg p-4">
                <div>
                    <label for="stars" class="block text-sm font-medium">Rating</label>
                    <select id="stars" name="stars" class="mt-1 block w-24 rounded border border-gray-300 p-1 text-sm">
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}">{{ $i }} {{ Str::plural('star', $i) }}</option>
                        @endfor
                    </select>
                    @error('stars')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="comment" class="block text-sm font-medium">Comment (optional)</label>
                    <textarea id="comment" name="comment" rows="3" wire:model.defer="comment"
                        class="mt-1 block w-full rounded border border-gray-300 p-2 text-sm"
                        placeholder="Write your thoughts..."></textarea>
                    @error('comment')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="rounded-3xl px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">Submit
                        review</button>
                </div>
            </form>

            @if ($successful)
                <div class="mt-5 text-sm text-green-700 bg-green-50 border border-green-200 rounded p-3">
                    Review submitted successfully!
                </div>
            @endif
        @endif
    @endauth
</div>