<?php namespace Orchestra\Story\Events;

use Orchestra\Story\Model\Content;
use Orchestra\Story\Facades\StoryFormat;

class ExtensionHandler
{
    /**
     * Handle on form view.
     *
     * @param  \Illuminate\Support\Fluent  $model
     * @param  \Orchestra\Html\Form\FormBuilder  $form
     *
     * @return void
     */
    public function handle($model, $form)
    {
        $form->extend(function ($form) use ($model) {
            $form->fieldset('Page Management', function ($fieldset) {
                $pages = array_merge(
                    ['_posts_' => 'Display Posts'],
                    Content::page()->publish()->lists('title', 'slug')
                );

                $fieldset->control('select', 'default_format')
                    ->label('Default Format')
                    ->options(StoryFormat::getParsers());

                $fieldset->control('select', 'default_page')
                    ->label('Default Page')
                    ->options($pages);

                $fieldset->control('text', 'Page Permalink', 'page_permalink');
                $fieldset->control('text', 'Post Permalink', 'post_permalink');
            });
        });
    }
}
