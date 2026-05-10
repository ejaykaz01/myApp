<x-guest-layout>
    <x-auth-session-status class="status-message" :status="session('status')" />

    <div class="auth-wrapper">
        <div class="auth-card">

            <!-- Header -->
            <div class="auth-header">
                <div class="auth-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M19 7v2.5A2.5 2.5 0 0116.5 12H7.5A2.5 2.5 0 015 9.5V7"/>
                    </svg>
                </div>
                <h1>Create Account</h1>
                <p>Get started in seconds</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Your name">
                    <x-input-error :messages="$errors->get('name')" class="error-box"/>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@email.com">
                    <x-input-error :messages="$errors->get('email')" class="error-box"/>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="error-box"/>
                </div>

                <!-- Confirm -->
                <div class="form-group">
                    <label>Confirm</label>
                    <input type="password" name="password_confirmation" required placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="error-box"/>
                </div>

                <!-- Actions -->
                <div class="actions">
                    <a href="{{ route('login') }}" class="link-secondary">
                        Already have an account?
                    </a>

                    <button type="submit" class="btn-primary">
                        Create Account
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
    width: 100%;
    max-width: 380px;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    border-radius: 14px;
    padding: 1.5rem;
    border: 1px solid #e5e7eb;
    box-shadow: 0 15px 30px rgba(0,0,0,0.08);
}

/* Header */
.auth-header {
    text-align: center;
    margin-bottom: 1.2rem;
}
.auth-header h1 {
    font-size: 1.4rem;
    font-weight: 600;
    background: linear-gradient(to right,#0f172a,#334155);
    -webkit-background-clip: text;
    color: transparent;
}
.auth-header p {
    font-size: 0.85rem;
    color: #6b7280;
}

/* Icon */
.auth-icon {
    width: 44px;
    height: 44px;
    margin: auto;
    margin-bottom: 0.5rem;
    border-radius: 10px;
    background: linear-gradient(to right,#0f172a,#1e293b);
    display: flex;
    align-items: center;
    justify-content: center;
}
.auth-icon svg {
    width: 20px;
    fill: white;
}

/* Form */
.form-group {
    margin-bottom: 0.8rem;
}
.form-group label {
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    color: #374151;
}

/* Inputs */
.form-group input {
    width: 100%;
    padding: 10px 12px;
    margin-top: 4px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    font-size: 0.9rem;
    transition: 0.2s;
}
.form-group input:focus {
    border-color: #334155;
    box-shadow: 0 0 0 2px rgba(51,65,85,0.1);
    outline: none;
}

/* Error */
.error-box {
    font-size: 0.7rem;
    color: #dc2626;
    margin-top: 3px;
}

/* Actions */
.actions {
    margin-top: 0.8rem;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

/* Link */
.link-secondary {
    font-size: 0.75rem;
    text-align: center;
    color: #475569;
    text-decoration: none;
}
.link-secondary:hover {
    color: #0f172a;
}

/* Button */
.btn-primary {
    background: #0f172a;
    color: white;
    padding: 10px;
    border-radius: 8px;
    font-size: 0.9rem;
    border: none;
    cursor: pointer;
}
.btn-primary:hover {
    background: #1e293b;
}

/* Status */
.status-message {
    max-width: 380px;
    margin: 0 auto 10px;
    font-size: 0.8rem;
    background: #f1f5f9;
    color: #0f172a;
    padding: 8px;
    border-radius: 8px;
    text-align: center;
}

/* Responsive */
@media (max-height: 700px) {
    .auth-wrapper {
        align-items: flex-start;
        padding-top: 1rem;
    }
}
</style>