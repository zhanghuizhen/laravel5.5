<?php

namespace App\Http\Controllers\Admin;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Topic as TopicModel;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'id' => 'numeric|min:1',
            'user_id' => 'numeric|min:1',
            'title' => 'string',
            'content' => 'string',
            'state' => 'string|in:published,offline',
            'publish_start_time' => 'date',
            'publish_end_time' => 'date',
            'per_page' => 'numeric'
        ]);

        $query = TopicModel::with('users');

        if ($request->has('id')) {
            $query->where('id', $request->get('id'));
        }

        if ($request->has('user_id')) {
            $query->where('user_id', $request->get('user_id'));
        }

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->get('title') . '%');
        }

        if ($request->has('content')) {
            $query->where('content', 'like', '%' . $request->get('content') . '%');
        }

        if ($request->has('state')) {
            $query->where('state', $request->get('state'));
        }

        if ($request->has('publish_start_time')) {
            $query->where('published_at', '>=', 'publush_start_time');
        }

        if ($request->has('publish_end_time')) {
            $query->where('published_at', '<=', 'publush_end_time');
        }

        $per_page = $request->get('per_page', $this->defaultRerPage());
        $data = $query->paginate($per_page);

        return Response::json([
            'code' => 0,
            'data' => $data,
        ]);
    }
}
