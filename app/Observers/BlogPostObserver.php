<?php
namespace App\Providers;
namespace App\Observers;


use App\Models\BlogPost;
use Barryvdh\Debugbar\ServiceProvider;
use Carbon\Carbon;



class BlogPostObserver
{


    /**
     * Handle the blog post "created" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function creating(BlogPost $blogPost)
    {
        /*$this->setPublishedAt($blogPost);
         $this->setSlog($blogPost); */
    }

    /**
     *  Обработка перед обновлением записи
     * Handle the blog post "updated" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function updating(BlogPost $blogPost)
    {
//           $test[] = $blogPost->isDirty();
//           $test[] = $blogPost->isDirty('is_published');
//            $test[] = $blogPost->isDirty('user_id');
//            $test[] = $blogPost->getAttribute('is_published');
//           $test[] = $blogPost->is_published;
//           $test[] = $blogPost->getOriginal('is_published');
//           dd($test);

        $this->setPublishedAt($blogPost);
      //  dd($blogPost);
        $this->setSlug($blogPost);
      //  return false;
    }

        /**
         * Если дата публикации не установлена и происходит установка флага - Опубликовано,
         *  то устанавливает дату публикации на текущую.
         * @param BlogPost $blogPost
         */
        protected function setPublishedAt(BlogPost $blogPost)
    {

        $needSetPublished = empty($blogPost->published_it) && $blogPost->is_published;

        if ($needSetPublished) {
            $blogPost->published_it = Carbon::now();
        }
    }

    /**
     * Если поле слаг пустое, то заполняем его ковертацией заголовка.
     *
     * @param BlogPost $blogPost
     *
     * @return void
     */

        protected function setSlug(BlogPost $blogPost)

    {


        if (empty($blogPost->slug)) {
            $blogPost->slug = \Str::slug($blogPost->title);

    }



    }

    /**
     * Handle the blog post "deleted" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the blog post "force deleted" event.
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
