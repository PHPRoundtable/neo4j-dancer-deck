<?php namespace DancerDeck\Http\Controllers;

use DancerDeck\Services\View\JavascriptManager;
use Illuminate\Support\Collection;
use Illuminate\View\View;

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
        $this->view->with('js', $this->js);
        $this->view->with('globalViewVars', $this->globalViewVars);

        $this->setDefaultGlobalVars();
        $this->setDefaultJavascript();
    }

    protected function setTitle($title)
    {
        //$this->globalViewVars->title = $title . ' :: ' . \Lang::get('default.meta.title');
        $this->globalViewVars->title = $title . ' :: Dancer Deck';
    }

    protected function setOpenGraphTags($title, $description, $url = null)
    {
        $this->view->with('meta', [
            'og:title' => $title,
            'og:description' => $description,
            'og:url' => $url ?: \Request::url(),
            'og:site_name' => \Lang::get('share.home.facebook.site_name'),
            'og:image' => \Lang::get('share.home.facebook.image'),
        ]);
    }

    protected function setDefaultGlobalVars()
    {
        //$this->globalViewVars->title = \Lang::get('default.meta.title');
        $this->globalViewVars->title = 'Dancer Deck';
        //$this->globalViewVars->isMobile = \Agent::isMobile();
        $this->globalViewVars->metaData = [];
        $this->view->with('links', [
            'home' => route('home'),
            'about' => url('about'),
            'contact' => url('contact'),
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