<nav class="app-nav" role="navigation" aria-label="Main navigation">
    <div class="app-nav__inner">

        <a href="/dashboard" class="app-nav__brand" aria-label="Home">
            <span class="app-nav__brand-icon">L</span>
            <span class="app-nav__brand-text">LostFound</span>
        </a>

        <button class="app-nav__toggle"
                onclick="toggleNav(this)"
                aria-label="Toggle menu"
                aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="app-nav__links" id="appNavLinks">
            <a href="/dashboard" class="nav-link" data-active="dashboard">Dashboard</a>
            <a href="/search" class="nav-link" data-active="search">Search</a>
            <a href="/community" class="nav-link" data-active="community">Community</a>
            <a href="/profile" class="nav-link" data-active="profile">Profile</a>

            @if(auth()->user()->role === 'admin')
                <a href="/admin/items" class="nav-link nav-link--admin" data-active="admin">Admin</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="nav-logout">
                @csrf
                <button type="submit" class="nav-link nav-link--logout">Sign out</button>
            </form>
        </div>

    </div>
</nav>

<style>

.app-nav {
    --nav-bg: #111827;
    --nav-border: #374151;
    --text-primary: #f9fafb;
    --text-secondary: #d1d5db;
    --text-muted: #9ca3af;
    --bg-hover: rgba(255, 255, 255, 0.08);
    --bg-active: rgba(255, 255, 255, 0.12);
    --radius: 8px;
    --transition: all 0.15s ease;
    --accent: #1e293b;
    --accent-hover: #111827;

    background: linear-gradient(135deg, #0f172a 0%, #1e293b 75%, #1e40af 100%);
    color: var(--text-primary);
    position: sticky;
    top: 0;
    z-index: 999;
    width: 100%;
    border-bottom: 1px solid var(--nav-border);
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}

.app-nav__inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.app-nav__brand {
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    color: var(--text-primary);
    font-size: 18px;
    font-weight: 600;
    padding: 8px 12px;
    border-radius: var(--radius);
    transition: var(--transition);
}

.app-nav__brand:hover {
    background: var(--bg-hover);
}

.app-nav__brand-icon {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    font-weight: 700;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
}

.app-nav__links {
    display: flex;
    align-items: center;
    gap: 6px;
}

.app-nav .nav-link {
    display: flex;
    align-items: center;
    padding: 8px 16px;
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 15px;
    font-weight: 500;
    border-radius: var(--radius);
    transition: var(--transition);
    border: 1px solid transparent;
    white-space: nowrap;
}

.app-nav .nav-link:hover {
    background: var(--bg-hover);
    color: var(--text-primary);
}

.app-nav .nav-link--active {
    color: var(--text-primary);
    background: var(--bg-active);
    border-color: rgba(255,255,255,0.2);
}

.app-nav .nav-link--logout {
    color: var(--text-muted);
}

.app-nav__toggle {
    display: none;
    flex-direction: column;
    justify-content: center;
    gap: 4px;
    width: 34px;
    height: 34px;
    background: transparent;
    border: none;
    cursor: pointer;
}

.app-nav__toggle span {
    width: 22px;
    height: 2px;
    background: white;
    border-radius: 2px;
}

@media (max-width: 1024px) {

    .app-nav__toggle {
        display: flex;
    }

    .app-nav__links {
        position: fixed;
        top: 0;
        right: -100%;
        height: 100vh;
        width: 280px;
        background: var(--nav-bg);
        flex-direction: column;
        padding: 80px 24px;
        border-left: 1px solid var(--nav-border);
        transition: right 0.25s ease;
        z-index: 1000;
    }

    .app-nav__links.show {
        right: 0;
    }

    .app-nav .nav-link {
        width: 100%;
        padding: 14px;
    }
}
</style>

<script>
function toggleNav(btn) {
    const menu = document.getElementById('appNavLinks');

    menu.classList.toggle('show');

    if (btn) {
        btn.setAttribute(
            'aria-expanded',
            menu.classList.contains('show') ? 'true' : 'false'
        );
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const path = window.location.pathname;

    document.querySelectorAll('.nav-link[data-active]').forEach(link => {
        const key = link.getAttribute('data-active');

        if (path.includes(key)) {
            link.classList.add('nav-link--active');
        }
    });
});
</script>