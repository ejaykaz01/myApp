<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Campus Lost & Found Management System - Institutional platform for reporting, tracking, and recovering lost items across campus facilities.">
    
    <title>{{ config('app.name', 'Campus System') }} - Lost & Found</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;450;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --black: #0a0a0a;
            --gray-900: #111827;
            --gray-800: #1f2937;
            --gray-700: #374151;
            --gray-600: #4b5563;
            --gray-500: #6b7280;
            --gray-400: #9ca3af;
            --gray-300: #d1d5db;
            --gray-200: #e5e7eb;
            --gray-100: #f3f4f6;
            --gray-50: #f9fafb;
            --white: #ffffff;
            
            --accent-500: #6366f1;
            --accent-600: #4f46e5;
            
            --space-4: 1rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-12: 3rem;
            --space-16: 4rem;
            --space-20: 5rem;
            --space-24: 6rem;
            --space-32: 8rem;
            
            --radius-sm: 0.5rem;
            --radius-lg: 1rem;
            
            --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.08);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 25px 50px -12px rgb(0 0 0 / 0.15);
            
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 5rem;
        }

        body {
            margin: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-size: 1rem;
            line-height: 1.65;
            color: var(--gray-900);
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .app-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--space-8);
        }

        .header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--gray-200);
            box-shadow: var(--shadow-sm);
        }

        .header-inner {
            height: 5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--black) 0%, var(--accent-500) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
            letter-spacing: -0.025em;
            transition: var(--transition);
        }

        .logo:hover {
            transform: translateY(-1px);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }

        .btn {
            padding: 0.875rem 2rem;
            border: 1px solid transparent;
            border-radius: var(--radius-sm);
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            white-space: nowrap;
            height: 3.25rem;
            font-feature-settings: 'cv02', 'ss01';
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: var(--transition);
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: var(--black);
            color: var(--white);
            border-color: var(--black);
            box-shadow: var(--shadow-md);
        }

        .btn-primary:hover:not(:disabled) {
            background: var(--gray-900);
            border-color: var(--gray-900);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-secondary {
            background: var(--white);
            color: var(--black);
            border-color: var(--gray-300);
        }

        .btn-secondary:hover:not(:disabled) {
            background: var(--gray-50);
            border-color: var(--gray-700);
            box-shadow: var(--shadow-sm);
        }

        .section {
            padding: var(--space-32) 0;
            position: relative;
            overflow: hidden;
        }

        .section-hero {
            padding-top: var(--space-32);
            padding-bottom: var(--space-24);
            text-align: center;
        }

        .section-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent-500), transparent);
            opacity: 0.3;
        }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: var(--space-8);
            padding: 0.375rem 1rem;
            background: var(--gray-100);
            border-radius: var(--radius-sm);
            position: relative;
        }

        .section-tag::before {
            content: '';
            width: 2px;
            height: 20px;
            background: var(--accent-500);
            border-radius: 1px;
        }

        .h1 {
            font-size: clamp(2.75rem, 7vw, 5rem);
            font-weight: 800;
            line-height: 1.1;
            margin: 0 0 var(--space-12) 0;
            letter-spacing: -0.03em;
            background: linear-gradient(135deg, var(--black) 0%, var(--gray-800) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-lead {
            font-size: 1.25rem;
            line-height: 1.75;
            color: var(--gray-700);
            margin: 0 auto var(--space-20) auto;
            max-width: 44rem;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-6);
            justify-content: center;
            margin-bottom: var(--space-24);
        }

        .section-title {
            font-size: 2.25rem;
            font-weight: 700;
            line-height: 1.2;
            margin: 0 0 var(--space-16) 0;
            text-align: center;
            letter-spacing: -0.015em;
            color: var(--black);
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 3rem;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-500), var(--accent-600));
            margin: 1rem auto 0;
            border-radius: 2px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(22rem, 1fr));
            gap: var(--space-8);
        }

        .card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            padding: var(--space-8);
            transition: var(--transition);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--accent-500), transparent);
            opacity: 0;
            transition: var(--transition);
        }

        .card:hover {
            border-color: var(--gray-300);
            box-shadow: var(--shadow-lg);
            transform: translateY(-4px);
        }

        .card:hover::before {
            opacity: 1;
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin: 0 0 var(--space-4) 0;
            color: var(--black);
            line-height: 1.3;
        }

        .card-text {
            margin: 0;
            color: var(--gray-700);
            font-size: 1rem;
            line-height: 1.65;
        }

        .footer {
            margin-top: auto;
            background: var(--white);
            border-top: 1px solid var(--gray-200);
            color: var(--gray-600);
            font-size: 0.875rem;
            padding: var(--space-16) 0;
            text-align: center;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        @media (max-width: 768px) {
            .container {
                padding-left: var(--space-6);
                padding-right: var(--space-6);
            }
            
            .hero-actions {
                flex-direction: column;
                align-items: stretch;
            }
            
            .btn {
                justify-content: center;
            }
            
            .grid {
                grid-template-columns: 1fr;
                gap: var(--space-6);
            }
            
            .section {
                padding-top: var(--space-20);
                padding-bottom: var(--space-20);
            }
        }

        .btn:focus-visible,
        .logo:focus-visible {
            outline: 2px solid var(--accent-500);
            outline-offset: 2px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section {
            animation: fadeInUp 0.8s ease-out;
        }

        .section:nth-child(2) { animation-delay: 0.1s; }
        .section:nth-child(3) { animation-delay: 0.2s; }
    </style>
</head>

<body class="app-wrapper">
    <header class="header" role="banner">
        <div class="container header-inner">
            <a href="/" class="logo" aria-label="Home">
                {{ config('app.name', 'Campus System') }}
            </a>

            <nav class="nav-actions" role="navigation" aria-label="Authentication">
                @auth
                    <a class="btn btn-primary" href="{{ url('/dashboard') }}">
                        Dashboard
                    </a>
                @else
                    <a class="btn btn-secondary" href="{{ route('login') }}">
                        Sign in
                    </a>
                    @if (Route::has('register'))
                        <a class="btn btn-primary" href="{{ route('register') }}">
                            Get started
                        </a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>

    <main role="main">
        <section class="section section-hero" aria-labelledby="hero-heading">
            <div class="container">
                <h1 id="hero-heading" class="sr-only">Campus Lost & Found Management System</h1>
                
                <div class="section-tag">
                    Institutional Platform
                </div>
                
                <h2 class="h1">
                    Campus Lost & Found
                </h2>
                
                <p class="section-lead">
                    Centralized platform for reporting, tracking, and recovering lost items 
                    across campus facilities. Built for institutional scale, security, and reliability.
                </p>
                
                <div class="hero-actions">
                    @auth
                        <a class="btn btn-primary" href="{{ url('/dashboard') }}">
                            Go to Dashboard
                        </a>
                    @else
                        <a class="btn btn-primary" href="{{ route('login') }}">
                            Sign In
                        </a>
                        @if (Route::has('register'))
                            <a class="btn btn-secondary" href="{{ route('register') }}">
                                Create Account
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </section>

        <section class="section" aria-labelledby="features-1-heading">
            <div class="container">
                <h2 id="features-1-heading" class="section-title">How It Works</h2>
                
                <div class="grid">
                    <article class="card">
                        <h3 class="card-title">Report Item</h3>
                        <p class="card-text">
                            Submit lost or found items with complete details, location, 
                            timestamp, and photos for immediate processing.
                        </p>
                    </article>
                    
                    <article class="card">
                        <h3 class="card-title">Smart Matching</h3>
                        <p class="card-text">
                            AI-powered system organizes reports and intelligently matches 
                            lost items with found items across campus.
                        </p>
                    </article>
                    
                    <article class="card">
                        <h3 class="card-title">Secure Recovery</h3>
                        <p class="card-text">
                            Verified users claim items through secure multi-step process 
                            with full audit trail and real-time notifications.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" aria-labelledby="features-2-heading">
            <div class="container">
                <h2 id="features-2-heading" class="section-title">Enterprise Capabilities</h2>
                
                <div class="grid">
                    <article class="card">
                        <h3 class="card-title">Real-time Search</h3>
                        <p class="card-text">
                            Advanced search across all reported items with filtering by 
                            location, category, date, and status.
                        </p>
                    </article>
                    
                    <article class="card">
                        <h3 class="card-title">Status Tracking</h3>
                        <p class="card-text">
                            Complete end-to-end visibility from report submission to 
                            resolution with automated notifications.
                        </p>
                    </article>
                    
                    <article class="card">
                        <h3 class="card-title">Role Management</h3>
                        <p class="card-text">
                            Granular permissions for students, staff, faculty, and 
                            administrators with full compliance audit logs.
                        </p>
                    </article>
                    
                    <article class="card">
                        <h3 class="card-title">Analytics Dashboard</h3>
                        <p class="card-text">
                            Institutional-grade reporting, recovery statistics, 
                            and performance metrics for administration.
                        </p>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer" role="contentinfo">
        <div class="container">
            <p>
                &copy; {{ date('Y') }} {{ config('app.name', 'Campus System') }}. 
                Institutional property management platform. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>