<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark">
      <a href=".">
        <img src="./static/logo.svg" width="110" height="32" alt="Logo" class="navbar-brand-image">
      </a>
    </h1>
    <div class="collapse navbar-collapse" id="sidebar-menu">
      <ul class="navbar-nav">
        @foreach ($accessibleMenus as $menu)
            <li class="nav-item {{ $menu['is_dropdown'] ? 'dropdown' : '' }}">
                <a href="{{ $menu['url'] ?: '#' }}" 
                   class="nav-link {{ $menu['is_dropdown'] ? 'dropdown-toggle' : '' }}" 
                   {{ $menu['is_dropdown'] ? 'data-bs-toggle=dropdown' : '' }}>
                    <i class="{{ $menu['icon'] }}"></i>
                    <span>{{ $menu['name'] }}</span>
                </a>
                @if ($menu['is_dropdown'] && count($menu['children']) > 0)
                    <ul class="dropdown-menu">
                        @foreach ($menu['children'] as $child)
                            <li>
                                <a href="{{ $child['url'] }}" class="dropdown-item">
                                    {{ $child['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
  </div>  
</aside>
