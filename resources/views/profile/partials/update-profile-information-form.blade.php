<section class="profile-card">
    <header class="profile-header">
        <h2>Profile Information</h2>

        <p>
            Update your account's profile information and email address.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="form">
        @csrf
        @method('patch')

        <div class="form-group">
            <label>Name</label>
            <input id="name" name="name" type="text"
                   value="{{ old('name', $user->name) }}"
                   required autofocus autocomplete="name">
            <span class="error">@error('name') {{ $message }} @enderror</span>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input id="email" name="email" type="email"
                   value="{{ old('email', $user->email) }}"
                   required autocomplete="username">

            <span class="error">@error('email') {{ $message }} @enderror</span>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="alert">
                    <p>Your email address is unverified.</p>

                    <button form="send-verification" class="link-btn">
                        Resend verification email
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="success-msg">
                            A new verification link has been sent.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="form-actions">
            <button type="submit">Save</button>

            @if (session('status') === 'profile-updated')
                <span class="saved">Saved.</span>
            @endif
        </div>
    </form>
</section>

<style>
.profile-card{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:14px;
    padding:20px;
}

.profile-header h2{
    font-size:18px;
    font-weight:800;
    color:#111827;
}

.profile-header p{
    font-size:13px;
    color:#6b7280;
    margin-top:4px;
}

.form{
    margin-top:16px;
    display:flex;
    flex-direction:column;
    gap:14px;
}

.form-group label{
    font-size:13px;
    font-weight:600;
    color:#111827;
    display:block;
    margin-bottom:6px;
}

.form-group input{
    width:100%;
    padding:10px 12px;
    border:1px solid #e5e7eb;
    border-radius:10px;
    font-size:13px;
    outline:none;
}

.form-group input:focus{
    border-color:#111827;
}

.error{
    font-size:12px;
    color:#dc2626;
}

.alert{
    margin-top:10px;
    padding:10px;
    background:#f9fafb;
    border:1px solid #e5e7eb;
    border-radius:10px;
    font-size:13px;
    color:#374151;
}

.link-btn{
    margin-top:6px;
    background:none;
    border:none;
    color:#111827;
    font-weight:600;
    cursor:pointer;
    text-decoration:underline;
}

.success-msg{
    margin-top:6px;
    color:#16a34a;
    font-size:12px;
}

.form-actions{
    display:flex;
    align-items:center;
    gap:12px;
    margin-top:10px;
}

.form-actions button{
    background:#111827;
    color:#fff;
    border:none;
    padding:10px 14px;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
}

.saved{
    font-size:13px;
    color:#16a34a;
}
</style>