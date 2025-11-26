<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Notifications\ProjectPublishNotification;

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

        return redirect()->back();
    }
}
