<?php namespace DancerDeck\Http\Controllers\Admin;

use DancerDeck\Http\Controllers\Controller;
use DancerDeck\Services\View\JavascriptManager;
use DancerDeck\Core\NavBar;
use DancerDeck\Core\EloquentRepository;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\Factory as ViewFactory;

abstract class AbstractController extends Controller
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
     * @var ViewFactory
     */
    protected $view;

    /**
     * @var NavBar
     */
    protected $mainNav;

    /**
     * @var NavBar
     */
    protected $subNav;

    /**
     * @var NavBar
     */
    protected $breadcrumbNav;

    public function __construct()
    {
        $this->js = new JavascriptManager();
        $this->globalViewVars = new Collection();
        $this->mainNav = new NavBar();
        $this->subNav = new NavBar();
        $this->breadcrumbNav = new NavBar();
        $this->view = view();

        // Share with the world!
        $this->view->share('js', $this->js);
        $this->view->share('globalViewVars', $this->globalViewVars);
        $this->view->share('mainNav', $this->mainNav);
        $this->view->share('subNav', $this->subNav);
        $this->view->share('breadcrumbNav', $this->breadcrumbNav);

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
        $this->view->share('meta', [
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
        $this->view->share('links', [
          'home' => url('/'),
          'logout' => url('auth/logout'),
          'event_index' => route('admin.event.index'),
          'event_create' => route('admin.event.create'),
        ]);

        // Main Navigation
        $this->mainNav->checkParentUrl(true);
        $this->mainNav->addNavItem('Dashboard', 'fa-dashboard', 'admin.home', [], false);
        $this->mainNav->addNavItem('Events', 'fa-calendar', 'admin.event.index');
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

    public function initRepo(EloquentRepository $repo, $id, $with = null)
    {
        $model = $repo->getById($id, $with);

        if ( ! $model) {
            \App::abort(404);
        }

        $repo->setModel($model);

        return $model;
    }

}