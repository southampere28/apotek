@php
    $sidebarId = $sidebarId ?? 'app-sidebar';
    $brandMark = $brandMark ?? 'A';
    $brandTitle = $brandTitle ?? 'Apotek Ujikom';
    $brandSubtitle = $brandSubtitle ?? 'Dashboard';
    $menuSections = $menuSections ?? [];
    $activeLabel = $activeLabel ?? 'Dashboard';
    $footerBadge = $footerBadge ?? $role ?? 'guest';
    $footerText = $footerText ?? '';
@endphp

<aside class="sidebar" id="{{ $sidebarId }}">
    <div class="brand">
        <div class="brand-mark">{{ $brandMark }}</div>
        <strong>{{ $brandTitle }}</strong>
        <small>{{ $brandSubtitle }}</small>
    </div>

    <div class="user-card">
        <div class="user-avatar">{{ $brandMark }}</div>
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
                            $isActive = $item['active'] ?? false;

                            if (! $isActive && $itemRouteName) {
                                $isActive = request()->routeIs($itemRouteName);
                            }
                        @endphp

                        <a
                            class="nav-link {{ $isActive ? 'active' : '' }}"
                            href="{{ $itemUrl }}"
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