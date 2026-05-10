<x-guest-layout>
    <x-auth-session-status class="status-message" :status="session('status')" />

    <div class="auth-wrapper">
        <div class="auth-card">

            <!-- Header -->
            <div class="auth-header">
                <div class="auth-icon">
                    <!-- User Icon -->
                    <svg viewBox="0 0 24 24">
                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>

                <h1>Welcome Back</h1>
                <p>Sign in to your account to continue</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0z"/>
                            </svg>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="Enter your email">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="error-box"/>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 15v2m-6 4h12"/>
                            </svg>
                        </span>
                        <input type="password" name="password" required placeholder="Enter your password">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="error-box"/>
                </div>

                <!-- Remember -->
                <label class="remember">
                    <input type="checkbox" name="remember">
                    <span></span>
                    Remember me
                </label>

                <!-- Actions -->
                <div class="actions">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot">
                            Forgot password?
                        </a>
                    @endif

                    <button type="submit" class="btn-primary">
                        Log in →
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>

<style>
/* Layout */


/* Card */
.auth-card {
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 2.5rem;
    border: 1px solid #e5e7eb;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    transition: 0.3s;
}
.auth-card:hover {
    box-shadow: 0 25px 50px rgba(0,0,0,0.12);
}

/* Header */
.auth-header {
    text-align: center;
    margin-bottom: 2rem;
}
.auth-header h1 {
    font-size: 1.8rem;
    font-weight: 700;
    background: linear-gradient(to right,#0f172a,#334155);
    -webkit-background-clip: text;
    color: transparent;
}
.auth-header p {
    color: #6b7280;
    font-size: 0.95rem;
}

/* Icon */
.auth-icon {
    width: 64px;
    height: 64px;
    margin: auto;
    margin-bottom: 1rem;
    border-radius: 12px;
    background: linear-gradient(to right,#0f172a,#1e293b);
    display: flex;
    align-items: center;
    justify-content: center;
}
.auth-icon svg {
    width: 28px;
    fill: white;
}

/* Form */
.form-group {
    margin-bottom: 1.2rem;
}
.form-group label {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    color: #111827;
}

/* Input */
.input-wrapper {
    position: relative;
    margin-top: 6px;
}
.input-wrapper input {
    width: 100%;
    padding: 14px 14px 14px 40px;
    border-radius: 12px;
    border: 2px solid #e5e7eb;
    font-size: 1rem;
    transition: 0.2s;
}
.input-wrapper input:focus {
    border-color: #64748b;
    box-shadow: 0 0 0 3px rgba(100,116,139,0.15);
    outline: none;
}

/* Icon inside input */
.input-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
}
.input-icon svg {
    width: 18px;
    fill: #9ca3af;
}

/* Error */
.error-box {
    font-size: 0.8rem;
    color: #dc2626;
    background: #fef2f2;
    padding: 6px 10px;
    border-radius: 8px;
    margin-top: 6px;
}

/* Checkbox */
.remember {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    margin: 1rem 0;
}
.remember input {
    accent-color: #0f172a;
}

/* Actions */
.actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* Forgot */
.forgot {
    text-align: center;
    font-size: 0.9rem;
    padding: 10px;
    border-radius: 10px;
    background: #f8fafc;
    text-decoration: none;
    color: #0f172a;
}
.forgot:hover {
    background: #e2e8f0;
}

/* Button */
.btn-primary {
    background: linear-gradient(to right,#0f172a,#1e293b);
    color: white;
    padding: 14px;
    border-radius: 12px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}

/* Status */
.status-message {
    margin-bottom: 1rem;
    background: #ecfdf5;
    color: #16a34a;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #bbf7d0;
}
</style>