<x-app-layout>

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
.search-page {
    --bg-primary: #fafbfc;
    --bg-card: #ffffff;
    --bg-glass: rgba(255, 255, 255, 0.8);
    --bg-hover: #f8fafc;
    
    --border: #e2e8f0;
    --border-hover: #cbd5e1;
    --border-focus: #a5b4fc;
    
    --text-primary: #0f172a;
    --text-secondary: #334155;
    --text-muted: #64748b;
    
    --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.08), 0 1px 2px -1px rgb(0 0 0 / 0.04);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 10px 10px -5px rgb(0 0 0 / 0.1);
    
    --radius-sm: 8px;
    --radius: 12px;
    --radius-lg: 16px;
    
    --space-xs: 4px;
    --space-sm: 8px;
    --space-md: 12px;
    --space-lg: 16px;
    --space-xl: 20px;
    --space-2xl: 24px;
    --space-3xl: 32px;
    --space-4xl: 40px;

     --accent: #1e293b;
    --accent-hover: #111827;
}

.search-page * {
    box-sizing: border-box;
}

.search-page {
    font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Segoe UI', Inter, system-ui, sans-serif;
    background: var(--bg-primary);
    color: var(--text-primary);
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
    backdrop-filter: blur(1px);
}

.search-layout {
    max-width: 64rem;
    margin: 0 auto;
    padding: 0 var(--space-2xl);
    min-height: 100vh;
}

.search-hero {
    text-align: center;
    padding: var(--space-4xl) 0 var(--space-3xl);
}

.search-hero__title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 800;
    margin: 0 0 var(--space-lg) 0;
    letter-spacing: -0.03em;
    line-height: 1.1;
    background: linear-gradient(135deg, var(--text-primary) 0%, #1e293b 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.search-hero__subtitle {
    font-size: clamp(1.125rem, 2.5vw, 1.25rem);
    font-weight: 400;
    margin: 0;
    color: var(--text-muted);
    max-width: 36rem;
    margin: 0 auto;
}

.search-glass {
    background: var(--bg-glass);
    backdrop-filter: blur(20px);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: var(--space-2xl);
    margin: var(--space-3xl) 0 var(--space-4xl) 0;
    box-shadow: var(--shadow-md);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.search-glass:hover {
    box-shadow: var(--shadow-lg);
    border-color: var(--border-hover);
}

.search-form {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: var(--space-xl);
    align-items: end;
}

.search-input-group,
.search-filter-group {
    position: relative;
}

.search-input,
.search-select {
    width: 100%;
    padding: var(--space-xl) var(--space-2xl);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 1.125rem;
    font-weight: 500;
    background: var(--bg-card);
    color: var(--text-primary);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    font-family: inherit;
}

.search-input::placeholder {
    color: var(--text-muted);
}

.search-input:focus,
.search-select:focus {
    outline: none;
    border-color: var(--border-focus);
    box-shadow: 0 0 0 4px rgba(165, 180, 252, 0.15);
    background: var(--bg-card);
    transform: translateY(-1px);
}

.search-select {
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right var(--space-xl) center;
    background-repeat: no-repeat;
    background-size: 1.25em;
    padding-right: calc(var(--space-2xl) + 1.25em);
    appearance: none;
    min-width: 12rem;
}

.search-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: var(--space-lg) var(--space-2xl);
    min-height: 3.5rem;
    background: linear-gradient(135deg, var(--accent) 0%, #1e40af 100%);
    color: #fff;
    border: none;
    border-radius: var(--radius);
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.01em;
    cursor: pointer;
    white-space: nowrap;
    box-shadow: var(--shadow-md);
    position: relative;
    overflow: hidden;
}

.search-button:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: var(--shadow-xl);
    background: linear-gradient(135deg, var(--accent-hover) 0%, #1e40af 100%);
}

.search-button:focus {
    outline: none;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.3);
}

.search-results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-2xl);
    padding-bottom: var(--space-xl);
    border-bottom: 1px solid var(--border);
}

.search-results-count {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-secondary);
    background: var(--bg-hover);
    padding: var(--space-sm) var(--space-md);
    border-radius: var(--radius-sm);
}

.search-results {
    display: grid;
    gap: var(--space-2xl);
}

.search-result {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: var(--shadow-sm);
    position: relative;
}

.search-result::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--border), transparent);
}

.search-result:hover {
    border-color: var(--border-hover);
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
}

.search-result__header {
    display: flex;
    align-items: flex-start;
    gap: var(--space-lg);
    padding: var(--space-2xl);
}

.search-result__badge {
    flex-shrink: 0;
    padding: var(--space-sm) var(--space-lg);
    border-radius: 9999px;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    backdrop-filter: blur(10px);
}

.search-result__badge--lost {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
    border: 1px solid rgba(239, 68, 68, 0.2);
}

.search-result__badge--found {
    background: rgba(34, 197, 94, 0.1);
    color: #059669;
    border: 1px solid rgba(34, 197, 94, 0.2);
}

.search-result__content {
    flex: 1;
}

.search-result__title {
    font-size: 1.5rem;
    font-weight: 800;
    margin: 0 0 var(--space-md) 0;
    line-height: 1.3;
    color: var(--text-primary);
    letter-spacing: -0.015em;
}

.search-result__description {
    color: var(--text-secondary);
    margin: 0 0 var(--space-lg) 0;
    font-size: 1.05rem;
    line-height: 1.7;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.search-result__meta {
    display: flex;
    align-items: center;
    padding: 0 var(--space-2xl) var(--space-2xl);
    border-top: 1px solid var(--border);
    font-size: 0.9rem;
    color: var(--text-muted);
}

.search-result__author {
    font-weight: 600;
    color: var(--text-secondary);
    margin-right: var(--space-md);
}

.search-result__divider {
    margin: 0 var(--space-md);
    opacity: 0.5;
}

.search-result__time {
    color: var(--text-muted);
}

.search-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 40vh;
    text-align: center;
    padding: var(--space-3xl);
    color: var(--text-muted);
}

.search-empty__icon {
    width: 5rem;
    height: 5rem;
    margin-bottom: var(--space-xl);
    background: linear-gradient(135deg, var(--border), var(--border-hover));
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    box-shadow: var(--shadow-md);
}

.search-empty__title {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0 0 var(--space-md) 0;
    color: var(--text-primary);
    letter-spacing: -0.02em;
}

.search-empty__subtitle {
    font-size: 1.125rem;
    margin: 0;
    max-width: 28rem;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .search-layout {
        padding: 0 var(--space-lg);
    }
    
    .search-form {
        grid-template-columns: 1fr;
        gap: var(--space-lg);
    }
    
    .search-results-header {
        flex-direction: column;
        align-items: stretch;
        gap: var(--space-lg);
    }
    
    .search-result__header {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-lg);
        padding: var(--space-xl);
    }
    
    .search-result__meta {
        padding: var(--space-xl);
    }
}

@media (max-width: 480px) {
    .search-layout {
        padding: 0 var(--space-md);
    }
    
    .search-glass {
        padding: var(--space-xl);
        margin: var(--space-2xl) 0;
    }
}
</style>

<div class="search-page">
    <main class="search-layout">
        <header class="search-hero" role="banner">
            <h1 class="search-hero__title" aria-label="Search Lost and Found Items">Search</h1>
            <p class="search-hero__subtitle">
                Find lost and found items across the entire system
            </p>
        </header>

        <section class="search-glass" role="search" aria-labelledby="search-hero__title">
            <form method="GET" action="/search" role="search">
                <div class="search-form">
                    <div class="search-input-group">
                        <input 
                            type="text" 
                            name="q" 
                            class="search-input"
                            placeholder="Search by title, description, or keywords..."
                            value="{{ request('q') }}"
                            aria-label="Search items"
                        >
                    </div>
                    
                    <div class="search-filter-group">
                        <select name="type" class="search-select" aria-label="Filter by item type">
                            <option value="">All items</option>
                            <option value="lost" {{ request('type')=='lost' ? 'selected' : '' }}>Lost Items</option>
                            <option value="found" {{ request('type')=='found' ? 'selected' : '' }}>Found Items</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="search-button" aria-label="Search">
                        <span>Search</span>
                    </button>
                </div>
            </form>
        </section>

        @if(count($items) > 0)
            <header class="search-results-header" aria-live="polite">
                <div class="search-results-count" aria-label="Number of results">
                    {{ count($items) }} result{{ count($items) === 1 ? '' : 's' }} found
                </div>
            </header>
            
            <section class="search-results" role="list" aria-label="Search results">
                @foreach($items as $item)
                    <article class="search-result" role="article">
                        <div class="search-result__header">
                            <span class="search-result__badge search-result__badge--{{ strtolower($item->type) }}" 
                                  aria-label="Item type: {{ ucfirst($item->type) }}">
                                {{ strtoupper($item->type) }}
                            </span>
                            
                            <div class="search-result__content">
                                <h2 class="search-result__title">{{ $item->title }}</h2>
                                
                                @if($item->description)
                                    <p class="search-result__description">{{ $item->description }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <footer class="search-result__meta">
                            <span class="search-result__author">
                                {{ $item->user_name }}
                            </span>
                            <span class="search-result__divider">•</span>
                            <time class="search-result__time" datetime="{{ $item->created_at }}">
                                {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                            </time>
                        </footer>
                    </article>
                @endforeach
            </section>
        @else
            <section class="search-empty" role="status" aria-live="polite">
                <div class="search-empty__icon" aria-hidden="true">🔍</div>
                <h2 class="search-empty__title">No results found</h2>
                <p class="search-empty__subtitle">
                    Try different keywords or adjust your filters. New items are added every day.
                </p>
            </section>
        @endif
    </main>
</div>

</x-app-layout>