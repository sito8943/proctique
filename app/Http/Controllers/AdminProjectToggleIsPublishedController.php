<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Notifications\ProjectPublishNotification;
use Illuminate\Support\Facades\Cache;

class AdminProjectToggleIsPublishedController extends Controller
{
    public function toggleIsPublished(string $id)
    {
        $project = Project::find($id);
        $publishing = $project->published_at === null;
        $project->update([
            'published_at' => $publishing ? now() : null,
        ]);

        if ($publishing) {
            $admins = User::where('is_admin', true)->get();
            foreach ($admins as $admin) {
                $admin->notify(new ProjectPublishNotification($project, auth()->user()));
            }
        }

        // Bust welcome caches impacted by publish state
        Cache::forget('welcome_page_recent_projects');
        Cache::forget('welcome_page_trending_projects');

        return redirect()->back();
    }
}
