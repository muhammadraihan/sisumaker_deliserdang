<ul id="js-nav-menu" class="nav-menu">
    <li>
        @hasrole('superadmin|tatausaha|sekda')
        <a href="{{route('backoffice.dashboard')}}" title="Dashboard" data-filter-tags="dashboard">
            <i class="fal fa-desktop"></i>
            <span class="nav-link-text">Dashboard</span>
        </a>
        <a href="{{route('surat.index')}}" title="Surat" data-filter-tags="surat">
            <i class="fal fa-edit"></i>
            <span class="nav-link-text">Surat</span>
        </a>
        @endhasrole
        @hasrole('bupati')
        <a href="{{route('sekda.index')}}" title="Surat" data-filter-tags="surat">
            <i class="fal fa-edit"></i>
            <span class="nav-link-text">Surat</span>
        </a>
        @endhasrole
       
    </li>
    @isset($menu)
    @foreach ($menu as $parent_menu)
    <li class="">
        <a href="{{$parent_menu->route_name ? route($parent_menu->route_name): '#'}}"
            title="{{$parent_menu->menu_title ? $parent_menu->menu_title:''}}">
            <i class="{{$parent_menu->icon_class ? $parent_menu->icon_class:''}}"></i>
            <span class="nav-link-text">{{$parent_menu->menu_title ?$parent_menu->menu_title:''}}</span>
        </a>
        @if (count($parent_menu->childs))
        <ul>
            @include('partials.submenu',['submenu' => $parent_menu->childs])
        </ul>
        @endif
    </li>
    @endforeach
    @endisset
</ul>