@if ($breadcrumbNav->hasNavItems())
    <ol class="breadcrumb">
        @foreach ($breadcrumbNav->getNavItems() as $navItem)
            <li class="{{ $navItem['isActive'] ? 'active' : '' }}">
                @if ($navItem['url'])
                    <a href="{{ $navItem['url'] }}">
                        @endif
                        {{ $navItem['icon'] ? '<i class="fa ' . $navItem['icon'] . '"></i>' : '' }}
                        {{ $navItem['anchor'] }}
                        @if ($navItem['url'])
                    </a>
                @endif
            </li>
        @endforeach
    </ol>
@endif
