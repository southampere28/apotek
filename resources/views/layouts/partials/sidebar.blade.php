@php
    $sidebarId = $sidebarId ?? 'app-sidebar';
    $brandMark = $brandMark ?? 'A';
    $brandLogoPath = $brandLogoPath ?? 'images/app_logo.png';
    $brandTitle = $brandTitle ?? config('apotek.brand_name', config('apotek.app_name', 'Farmasi Kita'));
    $brandSubtitle = $brandSubtitle ?? 'Dashboard';
    $menuSections = $menuSections ?? [];
    $activeLabel = $activeLabel ?? 'Dashboard';
    $footerBadge = $footerBadge ?? $role ?? 'guest';
    $footerText = $footerText ?? '';
@endphp

<aside class="sidebar" id="{{ $sidebarId }}">
    <div class="brand">
        <div class="brand-mark">
            <img src="{{ asset($brandLogoPath) }}" alt="{{ $brandTitle }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
        </div>
        <strong>{{ $brandTitle }}</strong>
        <small>{{ $brandSubtitle }}</small>
    </div>

    <div class="user-card">
        <div class="user-avatar">
            <img src="{{ asset($brandLogoPath) }}" alt="{{ $brandTitle }}" style="width: 100%; height: 100%; object-fit: cover; display: block; border-radius: 999px;">
        </div>
        <div class="user-info">
            <strong>{{ $activeLabel }}</strong>
            <span>{{ $footerBadge }}</span>
        </div>
    </div>

    <nav class="nav">
        @foreach ($menuSections as $section)
            <div class="nav-group">
                <div class="nav-label">{{ $section['label'] ?? 'Menu' }}</div>

                <div class="nav-list">
                    @foreach ($section['items'] ?? [] as $item)
                        @php
                            $itemRouteName = $item['routeName'] ?? null;
                            $itemUrl = $itemRouteName ? route($itemRouteName) : ($item['url'] ?? '#');
                            $itemTarget = $item['target'] ?? null;
                            $isActive = $item['active'] ?? false;

                            if (! $isActive && $itemRouteName) {
                                $isActive = request()->routeIs($itemRouteName);
                            }
                        @endphp

                        <a
                            class="nav-link {{ $isActive ? 'active' : '' }}"
                            href="{{ $itemUrl }}"
                            @if ($itemTarget)
                                target="{{ $itemTarget }}"
                                @if ($itemTarget === '_blank') rel="noopener noreferrer" @endif
                            @endif
                        >
                            <span>{{ $item['label'] ?? '' }}</span>
                            @if (! empty($item['badge']))
                                <span class="nav-badge">{{ $item['badge'] }}</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </nav>

    <div class="sidebar-footer">
        <div class="chip">{{ $footerBadge }}</div>
        @if ($footerText)
            <small>{{ $footerText }}</small>
        @endif
    </div>
</aside>