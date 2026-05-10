<x-app-layout>

<x-slot name="header">
    <div class="community-header">
        <div class="community-header__content">
            <div class="community-header__title-group">
                <h1 class="community-header__title">Community</h1>
                <p class="community-header__subtitle">Official announcements and system updates</p>
            </div>
        </div>
        
        @if(auth()->user()->role === 'admin')
            <button class="community-header__action" onclick="toggleComposer()" aria-expanded="false" aria-controls="composer">
                <svg class="community-header__action-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                New post
            </button>
        @endif
    </div>
</x-slot>

<style>

.community-page {
    --bg-primary: #fafbfc;
    --bg-card: #ffffff;
    --bg-hover: #f8fafc;
    --border: #e2e8f0;
    --border-hover: #cbd5e1;
    
    --text-primary: #0f172a;
    --text-secondary: #334155;
    --text-muted: #64748b;
    
    --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.08), 0 1px 2px -1px rgb(0 0 0 / 0.04);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    
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
}

.community-page * {
    box-sizing: border-box;
}

.community-page {
    font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Segoe UI', Inter, system-ui, sans-serif;
    background: var(--bg-primary);
    color: var(--text-primary);
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
}

.community-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: var(--space-2xl);
    padding-bottom: var(--space-2xl);
    border-bottom: 1px solid var(--border);
    margin-bottom: var(--space-3xl);
}

.community-header__content {
    flex: 1;
}

.community-header__title-group {
    display: flex;
    flex-direction: column;
    gap: var(--space-sm);
}

.community-header__title {
    font-size: clamp(1.75rem, 4vw, 2.25rem);
    font-weight: 800;
    margin: 0;
    letter-spacing: -0.025em;
    line-height: 1.2;
    color: var(--text-primary);
}

.community-header__subtitle {
    font-size: 1.125rem;
    font-weight: 400;
    margin: 0;
    color: var(--text-muted);
    max-width: 36rem;
}

.community-header__action {
    display: flex;
    align-items: center;
    gap: var(--space-md);
    padding: var(--space-lg) var(--space-xl);
    background: var(--bg-card);
    color: var(--text-primary);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    white-space: nowrap;
    box-shadow: var(--shadow-sm);
    position: relative;
    overflow: hidden;
}

.community-header__action::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.community-header__action:hover {
    border-color: var(--border-hover);
    background: var(--bg-hover);
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

.community-header__action:hover::before {
    left: 100%;
}

.community-header__action:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.2);
}

.community-header__action-icon {
    width: 1.25rem;
    height: 1.25rem;
    flex-shrink: 0;
}

.community-content {
    max-width: 52rem;
    margin: 0 auto;
    padding: 0 var(--space-xl);
}

.community-intro {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: var(--space-2xl);
    margin-bottom: var(--space-4xl);
    box-shadow: var(--shadow-sm);
    transition: all 0.2s ease;
}

.community-intro:hover {
    box-shadow: var(--shadow-md);
}

.community-intro__title {
    font-size: 1.375rem;
    font-weight: 700;
    margin: 0 0 var(--space-lg) 0;
    color: var(--text-primary);
    letter-spacing: -0.01em;
}

.community-intro__description {
    margin: 0;
    font-size: 1rem;
    color: var(--text-secondary);
    line-height: 1.7;
}

.community-composer {
    display: none;
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: var(--space-2xl);
    margin-bottom: var(--space-3xl);
    box-shadow: var(--shadow-sm);
    animation: slideDown 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-12px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.community-composer.show {
    display: block;
}

.community-composer__row {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: var(--space-xl);
    margin-bottom: var(--space-xl);
}

.community-composer__field {
    position: relative;
}

.community-composer__input,
.community-composer__textarea,
.community-composer__select {
    width: 100%;
    padding: var(--space-lg) var(--space-xl);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.95rem;
    font-family: inherit;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    background: var(--bg-hover);
}

.community-composer__input:focus,
.community-composer__textarea:focus,
.community-composer__select:focus {
    outline: none;
    border-color: var(--border-hover);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    background: var(--bg-card);
}

.community-composer__textarea {
    min-height: 6rem;
    resize: vertical;
    font-family: inherit;
}

.community-composer__submit {
    --accent: #1e293b;
    --accent-hover: #111827;
    
    padding: var(--space-lg) var(--space-xl);
    background: linear-gradient(135deg, var(--accent) 0%, #1e40af 100%);
    color: white;
    border: none;
    border-radius: var(--radius);
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    white-space: nowrap;
    box-shadow: var(--shadow-md);
}

.community-composer__submit:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-lg);
}

.community-posts {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--space-2xl);
    align-items: stretch;
}

.community-post {
    display: flex;
    flex-direction: column;
    height: 100%;
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: var(--shadow-sm);
}

@media (max-width: 1200px) {
    .community-posts {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .community-posts {
        grid-template-columns: 1fr;
    }
}

.community-post:hover {
    border-color: var(--border-hover);
    box-shadow: var(--shadow-lg);
    transform: translateY(-2px);
}

.community-post__header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: var(--space-2xl);
    gap: var(--space-xl);
}

.community-post__main {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: var(--space-md);
}

.community-post__title {
    font-size: 1.375rem;
    font-weight: 800;
    margin: 0;
    line-height: 1.3;
    color: var(--text-primary);
    letter-spacing: -0.015em;
}

.community-post__badge {
    display: inline-flex;
    align-items: center;
    padding: var(--space-sm) var(--space-lg);
    border-radius: 9999px;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    backdrop-filter: blur(10px);
    border: 1px solid transparent;
}

.community-post__badge--update {
    background: rgba(99, 102, 241, 0.1);
    color: #6366f1;
    border-color: rgba(99, 102, 241, 0.2);
}

.community-post__badge--announcement {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
    border-color: rgba(239, 68, 68, 0.2);
}

.community-post__badge--notice {
    background: rgba(245, 158, 11, 0.1);
    color: #d97706;
    border-color: rgba(245, 158, 11, 0.2);
}

.community-post__admin-indicator {
    display: inline-flex;
    align-items: center;
    gap: var(--space-xs);
    padding: var(--space-xs) var(--space-md);
    background: var(--text-primary);
    color: white;
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
}

.community-post__content {
    padding: 0 var(--space-2xl) var(--space-2xl);
    color: var(--text-secondary);
    font-size: 1rem;
    line-height: 1.7;
}

.community-post__footer {
    padding: var(--space-xl) var(--space-2xl);
    border-top: 1px solid var(--border);
    font-size: 0.875rem;
    color: var(--text-muted);
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.community-post__author {
    font-weight: 600;
    color: var(--text-secondary);
}

.community-post__time {
    opacity: 0.8;
}

.community-empty {
    text-align: center;
    padding: var(--space-4xl);
    color: var(--text-muted);
}

@media (max-width: 768px) {
    .community-header {
        flex-direction: column;
        align-items: stretch;
        gap: var(--space-xl);
    }
    
    .community-header__action {
        width: 100%;
        justify-content: center;
    }
    
    .community-content {
        max-width: 1400px;
    }
    
    .community-composer__row {
        grid-template-columns: 1fr;
    }
    
    .community-post__header {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-lg);
        padding: var(--space-xl);
    }
    
    .community-post__content {
        padding: 0 var(--space-xl) var(--space-xl);
    }
}

@media (max-width: 480px) {
    .community-content {
        padding: 0 var(--space-md);
    }
    
    .community-post__header,
    .community-post__content {
        padding-left: var(--space-md);
        padding-right: var(--space-md);
    }
}
</style>

<div class="community-page">
    <main class="community-content">
        <section class="community-intro" role="banner" aria-labelledby="intro-title">
            <h2 id="intro-title" class="community-intro__title">Welcome to Community Updates</h2>
            <p class="community-intro__description">
                Stay informed with official announcements, system updates, and important notices from the LostFound team.
            </p>
        </section>

        @if(auth()->user()->role === 'admin')
            <section class="community-composer" id="composer" role="form" aria-hidden="true">
                <form method="POST" action="/community/store">
                    @csrf
                    <div class="community-composer__row">
                        <div class="community-composer__field">
                            <input type="text" 
                                   name="title" 
                                   class="community-composer__input" 
                                   placeholder="Post title" 
                                   required 
                                   aria-label="Post title">
                        </div>
                        <div class="community-composer__field">
                            <select name="type" class="community-composer__select" required aria-label="Post type">
                                <option value="update">Update</option>
                                <option value="announcement">Announcement</option>
                                <option value="notice">Notice</option>
                            </select>
                        </div>
                    </div>
                    <div class="community-composer__field">
                        <textarea name="content" 
                                  class="community-composer__textarea" 
                                  placeholder="Write your post content..." 
                                  required 
                                  aria-label="Post content"></textarea>
                    </div>
                    <button type="submit" class="community-composer__submit" aria-label="Publish post">
                        Publish post
                    </button>
                </form>
            </section>
        @endif

        <article class="community-posts" role="feed" aria-label="Community posts">
            @forelse($announcements as $post)
                <article class="community-post" role="article" aria-labelledby="post-{{ $post->id }}-title">
                    <header class="community-post__header">
                        <div class="community-post__main">
                            <h2 id="post-{{ $post->id }}-title" class="community-post__title">{{ $post->title }}</h2>
                            
                            @if(isset($post->author_role) && $post->author_role === 'admin')
                                <span class="community-post__admin-indicator" aria-label="Admin post">Admin</span>
                            @endif
                        </div>
                        
                        <span class="community-post__badge community-post__badge--{{ $post->type }}" 
                              aria-label="Post type: {{ ucfirst($post->type) }}">
                            {{ ucfirst($post->type) }}
                        </span>
                    </header>
                    
                    <div class="community-post__content">
                        {!! $post->content !!}
                    </div>
                    
                    <footer class="community-post__footer">
                        <span class="community-post__author" aria-label="Author">
                            {{ $post->author ?? 'System' }}
                        </span>
                        <time class="community-post__time" 
                              datetime="{{ $post->created_at }}" 
                              aria-label="Posted">
                            {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                        </time>
                    </footer>
                </article>
            @empty
                <div class="community-empty" role="status" aria-live="polite">
                    <p>No posts yet. Check back soon for updates!</p>
                </div>
            @endforelse
        </article>
    </main>
</div>

<script>
function toggleComposer() {
    const composer = document.getElementById('composer');
    const button = document.querySelector('.community-header__action');
    const isExpanded = composer.classList.contains('show');
    
    composer.classList.toggle('show');
    composer.setAttribute('aria-hidden', isExpanded);
    
    button.setAttribute('aria-expanded', !isExpanded);
    button.innerHTML = isExpanded 
        ? '<svg class="community-header__action-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>New post'
        : '<svg class="community-header__action-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>Cancel';
    
    if (isExpanded) {
        composer.querySelector('form').reset();
    }
    
    if (!isExpanded) {
        composer.querySelector('.community-composer__input').focus();
    }
}

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && document.getElementById('composer')?.classList.contains('show')) {
        toggleComposer();
        e.preventDefault();
    }
    
    if ((e.ctrlKey || e.metaKey) && e.key === 'n' && authUserIsAdmin()) {
        e.preventDefault();
        toggleComposer();
    }
});

function authUserIsAdmin() {
    return {{ auth()->user()->role === 'admin' ? 'true' : 'false' }};
}
</script>

</x-app-layout>