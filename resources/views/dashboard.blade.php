<x-app-layout>

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
:root {
    --bg-primary: #fafbfc;
    --bg-secondary: #f8fafc;
    --bg-card: #ffffff;
    --bg-hover: #f1f5f9;
    --border: #e2e8f0;
    --border-hover: #cbd5e1;
    
    --text-primary: #0f172a;
    --text-secondary: #334155;
    --text-muted: #64748b;
    --text-light: #94a3b8;
    
    --accent: #1e293b;
    --accent-hover: #111827;
    
    --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    
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
}

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Inter', 'SF Pro Display', system-ui, sans-serif;
    background: var(--bg-primary);
    color: var(--text-primary);
    line-height: 1.6;
    font-size: 15px;
    font-weight: 400;
    -webkit-font-smoothing: antialiased;
    overflow: hidden;
}

.app {
    display: grid;
    grid-template-columns: 280px 1fr 340px;
    min-height: 100vh;
    overflow: hidden;
}

.sidebar {
    background: var(--bg-card);
    border-right: 1px solid var(--border);
    padding: var(--space-2xl);
    height: 100vh;
    overflow-y: auto;
    box-shadow: var(--shadow-sm);
}

.right-panel {
    background: var(--bg-card);
    border-left: 1px solid var(--border);
    height: 100vh;
    overflow-y: auto;
    box-shadow: var(--shadow-sm);
}

.feed {
    padding: var(--space-3xl);
    overflow-y: auto;
    height: 100vh;
}

.brand {
    background: linear-gradient(135deg, var(--accent) 0%, #1e40af 100%);
    color: white;
    padding: var(--space-xl) var(--space-2xl);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-3xl);
    text-align: center;
    box-shadow: var(--shadow-lg);
    backdrop-filter: blur(10px);
}

.logo {
    font-size: 24px;
    font-weight: 800;
    letter-spacing: -0.02em;
    margin-bottom: var(--space-sm);
}

.brand-sub {
    font-size: 14px;
    opacity: 0.95;
    font-weight: 500;
}

.nav {
    display: flex;
    flex-direction: column;
    gap: var(--space-md);
}

.nav-link {
    display: flex;
    align-items: center;
    gap: var(--space-lg);
    padding: var(--space-lg) var(--space-xl);
    border-radius: var(--radius);
    text-decoration: none;
    color: var(--text-secondary);
    font-size: 15px;
    font-weight: 500;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.nav-link::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    width: 3px;
    height: 0;
    background: var(--accent);
    transition: all 0.2s ease;
    transform: translateY(-50%);
}

.nav-link:hover {
    background: var(--bg-hover);
    color: var(--text-primary);
    transform: translateX(4px);
}

.nav-link.active {
    background: linear-gradient(90deg, var(--accent) 0%, #1e40af 100%);
    color: white;
    box-shadow: var(--shadow-md);
}

.nav-link.active::before {
    height: 24px;
}

.quick-btn {
    width: 100%;
    padding: var(--space-xl) var(--space-2xl);
    border: 1px solid transparent;
    background: linear-gradient(135deg, var(--accent) 0%, #1e40af 100%);
    color: white;
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    margin-bottom: var(--space-3xl);
    position: relative;
    overflow: hidden;
}

.quick-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.quick-btn:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-xl);
    border-color: rgba(255,255,255,0.2);
}

.quick-btn:hover::before {
    left: 100%;
}

.composer {
    display: flex;
    gap: var(--space-lg);
    align-items: center;
    padding: var(--space-2xl);
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-3xl);
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: var(--shadow-sm);
}

.composer:hover {
    border-color: var(--border-hover);
    box-shadow: var(--shadow-md);
    transform: translateY(-1px);
}

.avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), #1e40af);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 18px;
    flex-shrink: 0;
    box-shadow: var(--shadow-md);
}

.composer-input {
    flex: 1;
    border: none;
    background: var(--bg-hover);
    padding: var(--space-lg);
    border-radius: 999px;
    font-size: 15px;
    outline: none;
    color: var(--text-primary);
}

.composer-input::placeholder {
    color: var(--text-muted);
}

.post {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-2xl);
    position: relative;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.post:hover {
    box-shadow: var(--shadow-lg);
    border-color: var(--border-hover);
    transform: translateY(-2px);
}

.post::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--border), transparent);
}

.badge {
    position: absolute;
    top: var(--space-xl);
    right: var(--space-xl);
    font-size: 12px;
    font-weight: 700;
    padding: var(--space-xs) var(--space-md);
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    backdrop-filter: blur(10px);
}

.badge.lost {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
    border: 1px solid rgba(239, 68, 68, 0.2);
}

.badge.found {
    background: rgba(34, 197, 94, 0.1);
    color: #059669;
    border: 1px solid rgba(34, 197, 94, 0.2);
}

.post-head {
    display: flex;
    gap: var(--space-lg);
    padding: var(--space-2xl);
    align-items: flex-start;
}

.post-author {
    font-weight: 600;
    font-size: 16px;
    margin-bottom: var(--space-xs);
    color: var(--text-primary);
}

.post-meta {
    font-size: 14px;
    color: var(--text-muted);
    font-weight: 500;
}

.post-body {
    padding: 0 var(--space-2xl) var(--space-2xl);
}

.post-title {
    font-size: 22px;
    font-weight: 800;
    line-height: 1.3;
    margin-bottom: var(--space-md);
    color: var(--text-primary);
}

.post-desc {
    font-size: 16px;
    color: var(--text-secondary);
    line-height: 1.7;
    margin-bottom: var(--space-xl);
}

.post-image {
    width: 100%;
    border-radius: var(--radius);
    margin-top: var(--space-lg);
    box-shadow: var(--shadow-lg);
    transition: transform 0.3s ease;
}

.post:hover .post-image {
    transform: scale(1.02);
}

.like-text {
    padding: var(--space-xl) var(--space-2xl);
    font-size: 15px;
    color: var(--text-muted);
    border-top: 1px solid var(--border);
    background: var(--bg-hover);
    font-weight: 500;
}

.actions {
    display: flex;
    border-top: 1px solid var(--border);
    background: var(--bg-card);
}

.action-btn {
    flex: 1;
    padding: var(--space-lg) var(--space-xl);
    border: none;
    background: transparent;
    font-weight: 600;
    cursor: pointer;
    font-size: 15px;
    color: var(--text-secondary);
    transition: all 0.2s ease;
    border-right: 1px solid var(--border);
}

.action-btn:last-child {
    border-right: none;
}

.action-btn:hover {
    background: var(--bg-hover);
    color: var(--text-primary);
}

.action-btn:disabled {
    opacity: 0.4;
    cursor: not-allowed;
}

.comments {
    display: none;
    padding: var(--space-2xl);
    border-top: 1px solid var(--border);
    background: var(--bg-hover);
}

.comments.active {
    display: block;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.comment {
    margin-bottom: var(--space-lg);
    padding-bottom: var(--space-lg);
    border-bottom: 1px solid var(--border);
}

.comment:last-child {
    border-bottom: none;
}

.comment-bubble {
    display: inline-block;
    background: var(--bg-card);
    padding: var(--space-md) var(--space-lg);
    border-radius: var(--radius);
    font-size: 15px;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border);
}

.comment-bubble b {
    font-weight: 700;
}

.comment-box {
    display: flex;
    gap: var(--space-md);
    margin-top: var(--space-xl);
    padding-top: var(--space-xl);
    border-top: 1px solid var(--border);
}

.comment-input {
    flex: 1;
    padding: var(--space-lg);
    border: 1px solid var(--border);
    border-radius: 999px;
    font-size: 15px;
}

.comment-submit {
    padding: var(--space-lg) var(--space-xl);
    border: 1px solid var(--accent);
    background: var(--accent);
    color: white;
    border-radius: 999px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
}

.panel-card {
    background: var(--bg-secondary);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: var(--space-2xl);
    margin-bottom: var(--space-2xl);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--space-lg);
}

.stat-item {
    text-align: center;
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: var(--space-xl);
}

.stat-number {
    font-size: 28px;
    font-weight: 800;
}

.stat-label {
    font-size: 13px;
    color: var(--text-muted);
    text-transform: uppercase;
}

.panel-title {
    font-size: 14px;
    font-weight: 700;
    margin-bottom: var(--space-lg);
}

.panel-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.panel-list-item {
    font-size: 14px;
    color: var(--text-secondary);
    padding: var(--space-md);
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    margin-bottom: var(--space-sm);
}

.form-input, .form-textarea, .form-select {
    width: 100%;
    padding: var(--space-xl) var(--space-lg);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    margin-bottom: var(--space-lg);
    font-size: 15px;
    background: var(--bg-card);
}

.submit-btn {
    width: 100%;
    padding: var(--space-xl) var(--space-2xl);
    background: linear-gradient(135deg, var(--accent) 0%, #1e40af 100%);
    color: white;
    border: none;
    border-radius: var(--radius);
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
}

.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(15, 23, 42, 0.75);
    backdrop-filter: blur(12px);
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-box {
    width: 100%;
    max-width: 500px;
    background: var(--bg-card);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-xl);
}

@media (max-width: 1024px) {
    .app {
        grid-template-columns: 240px 1fr 300px;
    }

    .feed {
        padding: var(--space-2xl);
    }

    .sidebar,
    .right-panel {
        padding: var(--space-xl);
    }

    .post-title {
        font-size: 20px;
    }
}


@media (max-width: 900px) {
    .app {
        grid-template-columns: 220px 1fr;
    }

    .right-panel {
        display: none; 
    }

    .feed {
        padding: var(--space-xl);
    }
}


@media (max-width: 600px) {

    body {
        overflow: auto;
    }

    .app {
        grid-template-columns: 1fr;
    }

    .sidebar {
        display: none; 
    }

    .feed {
        height: auto;
        padding: var(--space-lg);
    }

    .composer {
        flex-direction: row;
        padding: var(--space-lg);
    }

    .avatar {
        width: 42px;
        height: 42px;
        font-size: 16px;
    }

    .post {
        margin-bottom: var(--space-xl);
    }

    .post-head {
        padding: var(--space-lg);
        gap: var(--space-md);
    }

    .post-title {
        font-size: 18px;
    }

    .post-desc {
        font-size: 14px;
    }

    .like-text {
        font-size: 13px;
        padding: var(--space-lg);
    }

    .action-btn {
        font-size: 14px;
        padding: var(--space-md);
    }

    .comment-input {
        font-size: 14px;
        padding: var(--space-md);
    }

    .comment-submit {
        font-size: 14px;
        padding: var(--space-md);
    }

    .modal-box {
        width: 92%;
    }
}


@media (max-width: 400px) {

    .post-title {
        font-size: 16px;
    }

    .post-desc {
        font-size: 13px;
    }

    .avatar {
        width: 38px;
        height: 38px;
        font-size: 14px;
    }

    .action-btn {
        font-size: 13px;
    }
}
</style>

<div class="app">

    <div class="sidebar">
        <div class="brand">
            <div class="logo">LFS</div>
            <div class="brand-sub">Lost & Found System</div>
        </div>

        <button class="quick-btn" onclick="openModal()">+ Report Item</button>

        <nav class="nav">
            <a href="/dashboard" class="nav-link {{ request('type') ? '' : 'active' }}">Dashboard</a>
            <a href="/dashboard?type=lost" class="nav-link {{ request('type')=='lost' ? 'active' : '' }}">Lost Items</a>
            <a href="/dashboard?type=found" class="nav-link {{ request('type')=='found' ? 'active' : '' }}">Found Items</a>
        </nav>
    </div>

    <div class="feed">
        <div class="composer" onclick="openModal()">
            <div class="avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'U',0,1)) }}
            </div>
            <input class="composer-input" placeholder="Report a lost or found item..." readonly>
        </div>

        @foreach($items as $item)
        <div class="post" data-post="{{ $item->id }}">
            <div class="badge {{ $item->type }}">
                {{ strtoupper($item->type) }}
            </div>

            <div class="post-head">

                @php
                    $name = trim($item->name ?? $item->user_name ?? '');
                    $initial = $name !== '' ? strtoupper($name[0]) : 'U';
                @endphp

                <a href="/user/{{ $item->user_id }}" style="text-decoration:none; color:inherit; display:flex; gap:10px; align-items:center;">
    
             <div class="avatar">{{ $initial }}</div>

                 <div>
        <div class="post-author">
            {{ $name !== '' ? $name : 'Anonymous User' }}
        </div>
        <div class="post-meta">
            {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
        </div>
    </div>

            </div>
</a>

            <div class="post-body">
                <h2 class="post-title">{{ $item->title }}</h2>

                @if($item->description)
                    <p class="post-desc">{{ $item->description }}</p>
                @endif

                @if($item->image)
                    <img src="/uploads/{{ $item->image }}" class="post-image" alt="Item image">
                @endif
            </div>

            <div class="like-text">
                {{ $item->likes_count ?? 0 }} people like this
            </div>

            <div class="actions">
                <button class="action-btn" onclick="likePost({{ $item->id }})">Like</button>
                <button class="action-btn" onclick="toggleComments({{ $item->id }})">Comment</button>
                @if(!isset($item->claim_status) || $item->claim_status !== 'approved')
                    <button class="action-btn" onclick="openClaim({{ $item->id }})">Claim</button>
                @else
                    <button class="action-btn" disabled>Claimed</button>
                @endif
            </div>

            <div class="comments" id="comments-{{ $item->id }}">
                <div id="comment-list-{{ $item->id }}">
                    @foreach($item->comments ?? [] as $c)
                        <div class="comment">
                            <span class="comment-bubble">
                                <b>{{ $c->user_name }}</b> {{ $c->comment }}
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="comment-box">
                    <input class="comment-input" id="comment-input-{{ $item->id }}" placeholder="Add a comment...">
                    <button class="comment-submit" onclick="sendComment({{ $item->id }})">Send</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="right-panel">

        <div class="panel-card">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">{{ $items->count() }}</div>
                    <div class="stat-label">Total</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $items->where('type','lost')->count() }}</div>
                    <div class="stat-label">Lost</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $items->where('type','found')->count() }}</div>
                    <div class="stat-label">Found</div>
                </div>
            </div>
        </div>

        <div class="panel-card">
            <h3 class="panel-title">Recent Activity</h3>
            <ul class="panel-list">
                @foreach($recentActivities as $activity)
                    <li class="panel-list-item">
                        {{ $activity->user_name ?? 'Anonymous' }} 
                        {{ $activity->type == 'lost' ? 'lost' : 'found' }} "{{ $activity->title }}"
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="panel-card">
            <h3 class="panel-title">Top Reporters</h3>
            <ul class="panel-list">
                @foreach($topReporters as $reporter)
                    <li class="panel-list-item">
                        {{ $reporter->name }} -{{ $reporter->items_count }} reports
                    </li>
                @endforeach
            </ul>
        </div>
    
        <div class="panel-card">
            <h3 class="panel-title">Quick Tips</h3>
            <ul class="panel-list">
                <li class="panel-list-item">After posting, you may submit the item to the Student Council Office</li>
                <li class="panel-list-item">Provide clear item photos</li>
                <li class="panel-list-item">Mention exact locations</li>
                <li class="panel-list-item">Keep descriptions concise</li>
                <li class="panel-list-item">Troll == Device Ban + OSA</li>
            </ul>
        </div>
    </div>
</div>

<div class="modal" id="modal">
    <div class="modal-box">
        <form id="postForm">
            @csrf
            <input class="form-input" name="title" placeholder="Item title" required>
            <textarea class="form-textarea" name="description" placeholder="Description (location, time, details...)"></textarea>
            <select class="form-select" name="type" required>
                <option value="">Select type</option>
                <option value="lost">Lost Item</option>
                <option value="found">Found Item</option>
            </select>
            <input class="form-input" type="file" name="image" accept="image/*">
            <button class="submit-btn" type="submit">Submit Report</button>
        </form>
    </div>
</div>

<div class="modal" id="claimModal">
    <div class="modal-box">
        <input type="hidden" id="claim_item_id">
        <textarea class="form-textarea" id="claim_message" placeholder="Explain why this is your item (details help us verify)" required></textarea>
        <button class="submit-btn" onclick="submitClaim()">Submit Claim</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

function openClaim(id){
    $('#claim_item_id').val(id);
    $('#claim_message').val('');
    $('#claimModal').css('display','flex');
}

function closeClaim(){
    $('#claimModal').hide();
}

$('#claimModal').click(function(e){
    if(e.target === this) closeClaim();
});

function submitClaim(){
    $.post('/items/claim/'+$('#claim_item_id').val(),{
        _token:'{{ csrf_token() }}',
        message:$('#claim_message').val()
    })
    .done(function(res){
        alert(res.message);
        closeClaim();
        location.reload();
    })
    .fail(function(xhr){
        alert(xhr.responseJSON?.message || 'Claim failed');
    });
}

let openComment=null;

function toggleComments(id){
    $('#comments-'+id).toggleClass('active');
}

function likePost(id){
    $.post('/items/like/' + id, {
        _token: $('meta[name="csrf-token"]').attr('content')
    })
    .done(function(res){
        let post = $('[data-post="'+id+'"]');
        post.find('.like-text').text(res.likes + ' people like this');
    });
}

function sendComment(id){
    let input = $('#comment-input-' + id);
    let comment = input.val();

    $.post('/items/comment/' + id, {
        _token: $('meta[name="csrf-token"]').attr('content'),
        comment: comment
    })
    .done(function(res){
        let html = `
            <div class="comment">
                <span class="comment-bubble">
                    <b>${res.user}</b> ${res.comment}
                </span>
            </div>
        `;
        $('#comment-list-' + id).append(html);
        input.val('');
    });
}

function openModal(){
    $('#modal').css('display','flex');
}

$('#postForm').on('submit', function(e){
    e.preventDefault();
    let formData = new FormData(this);
    $.ajax({
        url: '/items/store',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(res){
            alert('Posted successfully!');
            location.reload();
        },
        error: function(xhr){
            alert(xhr.responseJSON?.message || 'Post failed');
        }
    });
});

$('.modal').click(function(e){
    if(e.target === this) $(this).hide();
});
</script>

</x-app-layout>