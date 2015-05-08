<?php namespace DancerDeck\Core;

class NavBar
{
    /**
     * @var array
     */
    protected $nav = [];

    /**
     * @var bool Checks the parent URL for active state (for main navs).
     */
    protected $checkParentUrl = false;

    /**
     * Sets an item in a navigation element.
     *
     * @param string        $anchor
     * @param string|null   $icon
     * @param string|null   $route
     * @param array         $params
     * @param bool|null     $checkParentUrl
     */
    public function addNavItem($anchor, $icon = null, $route = null, $params = [], $checkParentUrl = null)
    {
        $url = null;
        $isActive = false;
        $parentIsActive = false;

        if ($route) {
            $currentUrl = \URL::current();
            $url = $parentUrl = route($route, $params);

            if ($params) {
                $parentUrl = route($route, '');
            }

            // Overwrite the default
            $checkParentUrl = isset($checkParentUrl) ? $checkParentUrl : $this->checkParentUrl;

            if ($checkParentUrl) {
                $parentIsActive = \Str::is($parentUrl . '*', $currentUrl);
            }

            $isActive = \Str::is($url, $currentUrl) || $parentIsActive;
        }

        $this->nav[] = [
            'anchor' => $anchor,
            'icon' => $icon,
            'url' => $url,
            'isActive' => $isActive,
        ];
    }

    /**
     * Checks for the existence of nav items.
     *
     * @return bool
     */
    public function hasNavItems()
    {
        return count($this->nav) > 0;
    }

    /**
     * Returns the array of navigation items.
     *
     * @return array
     */
    public function getNavItems()
    {
        return $this->nav;
    }

    /**
     * Sets the checkParentUrl option.
     *
     * @param bool
     */
    public function checkParentUrl($checkParentUrl = true)
    {
        $this->checkParentUrl = $checkParentUrl;
    }
}
