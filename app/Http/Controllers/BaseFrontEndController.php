<?php namespace DancerDeck\Http\Controllers;

use DancerDeck\Services\View\JavascriptManager;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\Factory as View;

class BaseFrontEndController extends Controller
{
    /**
     * @var JavascriptManager
     */
    protected $js;

    /**
     * @var Collection
     */
    protected $globalViewVars;

    /**
     * @var View
     */
    protected $view;

    public function __construct()
    {
        $this->js = new JavascriptManager();
        $this->globalViewVars = new Collection();

        // Share with the world!
        $this->view = view();
        $this->view->share('js', $this->js);
        $this->view->share('globalViewVars', $this->globalViewVars);

        $this->setDefaultGlobalVars();
        $this->setDefaultJavascript();
    }

    protected function setTitle($title)
    {
        $this->globalViewVars['title'] = $title.' :: '.trans('share.default.title');
    }

    protected function setOpenGraphTags($title, $description, $url = null)
    {
        $this->view->share('meta', [
            'og:title' => $title,
            'og:description' => $description,
            'og:url' => $url ?: url('/'),
            'og:site_name' => trans('share.home.facebook.site_name'),
            'og:image' => trans('share.home.facebook.image'),
        ]);
    }

    protected function setDefaultGlobalVars()
    {
        $this->globalViewVars['title'] = trans('share.default.title');
        //$this->globalViewVars['isMobile'] = \Agent::isMobile();
        $this->globalViewVars['metaData'] = [];
        $this->view->share('links', [
            'home' => url('/'),
            'about' => url('about'),
            'contact' => url('contact'),
            'privacy' => url('privacy'),
            'auth.register' => url('auth/register'),
            'auth.login' => url('auth/login'),
            'auth.logout' => url('auth/logout'),
            'events.browse' => url('events/browse'),
        ]);
    }

    protected function setDefaultJavascript()
    {
        // Tell js about our environment
        $env = env('APP_ENV');
        //$env = 'local';
        $this->js->give('env', $env);

        // Mobile version
        //$this->js->give('isMobile', \Agent::isMobile());
    }

}