<?php namespace Orchestra\Story\Routing;

use Illuminate\Routing\Controller;
use Illuminate\Support\Arr;
use Orchestra\Support\Facades\App;
use Orchestra\Support\Facades\Site;

abstract class ContentController extends Controller
{
    /**
     * Show the content.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $params = App::make('router')->current()->parameters();
        $id     = Arr::get($params, 'id');
        $slug   = Arr::get($params, 'slug');

        $page = $this->getRequestedContent($id, $slug);
        $id   = $page->id;
        $slug = $page->slug;

        Site::set('title', $page->title);

        return $this->getResponse($page, $id, $slug);
    }

    /**
     * Return the response, this method allow each content type to be group
     * via different set of view.
     *
     * @param  \Orchestra\Story\Model\Content   $page
     * @param  integer                          $id
     * @param  string                           $slug
     * @return \Illuminate\Http\Response
     */
    abstract protected function getResponse($page, $id, $slug);

    /**
     * Get the requested page/content from Model.
     *
     * @param  integer  $id
     * @param  string   $slug
     * @return \Orchestra\Story\Model\Content
     */
    abstract protected function getRequestedContent($id, $slug);
}
