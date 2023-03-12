<?php

namespace App\Observers;

use App\Jobs\SendMails;
use App\Models\Article;
use App\Models\User;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     */
    public function created(Article $article): void
    {
        info(asset('article/'. $article->id));
        $users = User::query()->get();
        dispatch(new SendMails($users, $article));
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Article $article): void
    {
        if ($article->type == 'video') {
            deleteFile($article->details);
        }
    }
}
