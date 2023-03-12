<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Jobs\SendMails;
use App\Mail\ArticleCreatedMail;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()->get();
        return successResponse($articles);
    }

    public function store(StoreArticleRequest $request)
    {
        $details = $request->details;
        if ($request->type == 'video' && $request->hasFile('details')) {
            $details = uploadFile('articles/videos', $request->details);
        }
        $article = Article::query()->create([
            'title' => $request->title,
            'details' => $details,
            'type' => $request->type,
            'user_id' => Auth::id(),
        ]);
        return successResponse($article);
    }

   public function show(Article $article)
    {
        return successResponse($article->load('author', 'comments'));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);
        $details = $request->details;
        if ($article->type == 'video' && $request->hasFile('details')) {
            $details = replaceFile($article->details, 'articles/videos', $request->details);
        }
        $article->update([
            'title' => $request->title,
            'details' => $details,
        ]);
        return successResponse($article );
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        return successMessage(__('general.deleted'));
    }
}
