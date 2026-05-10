<x-app-layout>

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="profile-page">

<style>
/* KEEP YOUR CSS EXACTLY AS YOU PROVIDED */
.profile-page * { box-sizing: border-box; }

.profile-page {
    --bg-primary: #fafbfc;
    --bg-card: #ffffff;
    --bg-hover: #f8fafc;
    --border: #e2e8f0;
    --border-hover: #cbd5e1;

    --text-primary: #0f172a;
    --text-secondary: #334155;
    --text-muted: #64748b;

    --accent: #1e293b;
    --accent-gradient: linear-gradient(135deg, #1e293b 0%, #1e40af 100%);

    --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
    --shadow-md: 0 4px 6px rgba(0,0,0,0.10);
    --shadow-lg: 0 10px 25px rgba(0,0,0,0.12);

    --radius: 12px;
    --radius-lg: 16px;

    min-height: 100vh;
    background: var(--bg-primary);
    color: var(--text-primary);
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Inter, system-ui, sans-serif;
}

/* HEADER */
.profile-header {
    background: var(--bg-card);
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 50;
    box-shadow: var(--shadow-sm);
}

.profile-header__inner {
    max-width: 1100px;
    margin: auto;
    padding: 14px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.profile-header__title {
    font-size: 18px;
    font-weight: 700;
}

/* HERO */
.profile-hero {
    max-width: 900px;
    margin: 30px auto;
    padding: 0 20px;
}

.profile-hero__card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px;
    box-shadow: var(--shadow-md);
}

.profile-hero__header {
    display: flex;
    gap: 20px;
    align-items: center;
}

.profile-hero__avatar {
    width: 70px;
    height: 70px;
    border-radius: 14px;
    background: var(--accent-gradient);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    font-weight: 800;
}

.profile-hero__details h1 {
    margin: 0;
    font-size: 24px;
    font-weight: 800;
}

.profile-hero__details p {
    margin: 4px 0 0;
    color: var(--text-muted);
}

/* STATS */
.profile-hero__stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid var(--border);
    text-align: center;
}

.profile-stat__number {
    font-size: 22px;
    font-weight: 800;
}

.profile-stat__label {
    font-size: 12px;
    color: var(--text-muted);
    text-transform: uppercase;
}

/* CONTENT */
.profile-content {
    max-width: 900px;
    margin: auto;
    padding: 0 20px 50px;
}

.profile-section__header {
    margin: 20px 0;
    border-bottom: 1px solid var(--border);
    padding-bottom: 10px;
}

.profile-section__title {
    font-size: 18px;
    font-weight: 800;
}

/* POSTS */
.profile-activity {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.profile-activity__item {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 16px;
    box-shadow: var(--shadow-sm);
    position: relative;
    transition: 0.2s;
}

.profile-activity__item:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.profile-activity__badge {
    position: absolute;
    top: 12px;
    right: 12px;
    padding: 4px 10px;
    font-size: 11px;
    border-radius: 999px;
    background: var(--accent-gradient);
    color: white;
    font-weight: 700;
}

.profile-activity__header {
    display: flex;
    gap: 12px;
    align-items: center;
    margin-bottom: 10px;
}

.profile-activity__avatar {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: var(--accent-gradient);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}

.profile-activity__title {
    font-weight: 800;
    margin: 0;
}

.profile-activity__description {
    color: var(--text-secondary);
    margin-top: 6px;
}

.profile-activity__image {
    width: 100%;
    margin-top: 10px;
    border-radius: 10px;
}

/* EMPTY */
.profile-empty {
    text-align: center;
    padding: 40px;
    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
}

.profile-empty__icon {
    font-size: 28px;
    margin-bottom: 10px;
}
</style>

<!-- HEADER -->
<header class="profile-header">
    <div class="profile-header__inner">
        <div class="profile-header__title">User Profile</div>
    </div>
</header>

@php
    $initial = strtoupper(substr($user->name ?? 'U', 0, 1));
@endphp

<!-- HERO -->
<section class="profile-hero">
    <div class="profile-hero__card">

        <div class="profile-hero__header">
            <div class="profile-hero__avatar">
                {{ $initial }}
            </div>

            <div class="profile-hero__details">
                <h1>{{ $user->name }}</h1>
                @if(($user->role ?? '') !== 'admin')
    <p>{{ $user->email }}</p>
@else
    <p class="profile-email-hidden">Admin</p>
@endif
            </div>
        </div>

        <div class="profile-hero__stats">
            <div>
                <div class="profile-stat__number">{{ ($posts ?? collect())->count() }}</div>
                <div class="profile-stat__label">Posts</div>
            </div>

            <div>
                <div class="profile-stat__number">
                    {{ ($posts ?? collect())->sum('likes_count') }}
                </div>
                <div class="profile-stat__label">Likes</div>
            </div>

            <div>
                <div class="profile-stat__number">{{ ($posts ?? collect())->count() }}</div>
                <div class="profile-stat__label">Activity</div>
            </div>
        </div>

    </div>
</section>

<!-- CONTENT -->
<main class="profile-content">

    <div class="profile-section__header">
        <div class="profile-section__title">Recent Activity</div>
    </div>

    <div class="profile-activity">

        @forelse($posts ?? [] as $item)
            <div class="profile-activity__item">

                <div class="profile-activity__badge">
                    {{ strtoupper($item->type) }}
                </div>

                <div class="profile-activity__header">

                    <div class="profile-activity__avatar">
                        {{ $initial }}
                    </div>

                    <div>
                        <div class="profile-activity__title">
                            {{ $item->title }}
                        </div>

                        <div class="profile-activity__description">
                            {{ $item->description }}
                        </div>
                    </div>

                </div>

                @if($item->image)
                    <img class="profile-activity__image" src="/uploads/{{ $item->image }}">
                @endif

            </div>
        @empty
            <div class="profile-empty">
                <div class="profile-empty__icon">📝</div>
                <div>No activity yet</div>
            </div>
        @endforelse

    </div>
</main>

</div>

</x-app-layout>