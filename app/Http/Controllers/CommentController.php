<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Article $article)
    {
        $comment = Comment::query()->create([
            'content' => $request->get('content') ,
            'user_id' => Auth::id(),
            'article_id' => $article->id,
        ]);
        return successResponse($comment);
    }

    public function show(Comment $comment)
    {
        return successResponse($comment);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        $comment->update([
            'content' => $request->get('content')
        ]);
        return successResponse($comment);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return successMessage(__('general.deleted'));
    }
}
