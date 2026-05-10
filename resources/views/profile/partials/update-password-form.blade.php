<section>

<style>
/* HEADER */
.sec-header h2{
    font-size:16px;
    font-weight:700;
    color:#111827;
    margin-bottom:4px;
}

.sec-header p{
    font-size:13px;
    color:#6b7280;
}

/* FORM */
.form-group{
    margin-top:14px;
}

label{
    display:block;
    font-size:12px;
    font-weight:600;
    color:#374151;
    margin-bottom:6px;
}

input{
    width:100%;
    padding:10px 12px;
    border:1px solid #e5e7eb;
    border-radius:10px;
    font-size:13px;
    outline:none;
}

input:focus{
    border-color:#111827;
}

/* BUTTON */
.btn-primary{
    background:#111827;
    color:#fff;
    padding:10px 14px;
    border:none;
    border-radius:10px;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
}

.btn-primary:hover{
    opacity:0.9;
}

/* STATUS TEXT */
.status{
    font-size:12px;
    color:#16a34a;
}
</style>

<div class="sec-header">
    <h2>Update Password</h2>
    <p>Ensure your account is using a strong password for security.</p>
</div>

<form method="post" action="{{ route('password.update') }}" style="margin-top:16px;">
    @csrf
    @method('put')

    <!-- CURRENT -->
    <div class="form-group">
        <label>Current Password</label>
        <input type="password" name="current_password" autocomplete="current-password">
        @error('current_password', 'updatePassword')
            <div style="color:red;font-size:12px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- NEW -->
    <div class="form-group">
        <label>New Password</label>
        <input type="password" name="password" autocomplete="new-password">
        @error('password', 'updatePassword')
            <div style="color:red;font-size:12px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- CONFIRM -->
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" autocomplete="new-password">
        @error('password_confirmation', 'updatePassword')
            <div style="color:red;font-size:12px;">{{ $message }}</div>
        @enderror
    </div>

    <!-- BUTTON -->
    <div style="margin-top:16px;display:flex;align-items:center;gap:10px;">
        <button type="submit" class="btn-primary">Save</button>

        @if (session('status') === 'password-updated')
            <div class="status">Saved successfully.</div>
        @endif
    </div>

</form>

</section>