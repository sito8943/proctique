<?php

use App\Models\Project;

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component {
    public Project $project;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    protected $listeners = ['review-added' => 'refreshReviews'];

    #[On('review-added')]
    public function refreshReviews()
    {
        $this->project->refresh();
    }
};
?>

<ul class="flex flex-col gap-4">
    @forelse ($project->reviews as $review)
        <li class="border border-slate-100 rounded-lg p-4 flex gap-4">
            <x-media-image :model="$review->author" class="w-10 h-10 rounded-full object-cover bg-gray-300"
                :alt="$review->author->name" />
            <div class="flex-1">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-medium">{{ $review->author->name }}</span>
                    <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                </div>
                <x-stars :value="$review->stars" class="text-yellow-600" />
                @if ($review->comment)
                    <p class="text-sm mt-1">{{ $review->comment }}</p>
                @endif
            </div>
        </li>
    @empty
        <li class="text-sm text-gray-600">No reviews yet.</li>
    @endforelse
</ul>