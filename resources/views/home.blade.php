<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoJac – API de Descarte Seletivo | Projeto de TCC</title>
    <meta name="description" content="EcoJac: API REST para informações sobre coleta seletiva, pontos de descarte, dicas de higienização e guia de materiais recicláveis em Jacareí.">
    <meta name="keywords" content="EcoJac, coleta seletiva, reciclagem, Jacareí, API, descarte correto, lixo seletivo, TCC">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        /* ── Reset & Custom Properties ──────────── */
        :root {
            --bg-primary: #0a0f0d;
            --bg-secondary: #111a15;
            --bg-card: rgba(20, 34, 26, 0.6);
            --bg-card-hover: rgba(28, 48, 36, 0.7);
            --border: rgba(34, 197, 94, 0.15);
            --border-hover: rgba(34, 197, 94, 0.35);
            --text-primary: #e8f5e9;
            --text-secondary: #94b8a0;
            --text-muted: #5e7d68;
            --accent: #22c55e;
            --accent-dim: #166534;
            --accent-glow: rgba(34, 197, 94, 0.15);
            --accent-glow-strong: rgba(34, 197, 94, 0.25);
            --surface-glass: rgba(34, 197, 94, 0.04);
            --radius-sm: 10px;
            --radius-md: 16px;
            --radius-lg: 24px;
            --radius-xl: 32px;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: "Inter", -apple-system, "Segoe UI", sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.7;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── Ambient Background ─────────────────── */
        .ambient-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .ambient-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            animation: float 20s ease-in-out infinite;
        }

        .ambient-orb:nth-child(1) {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.08), transparent 70%);
            top: -10%;
            left: -10%;
            animation-delay: 0s;
        }

        .ambient-orb:nth-child(2) {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.06), transparent 70%);
            bottom: -15%;
            right: -10%;
            animation-delay: -7s;
        }

        .ambient-orb:nth-child(3) {
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.05), transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: -14s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(30px, -20px) scale(1.05); }
            50% { transform: translate(-20px, 15px) scale(0.95); }
            75% { transform: translate(15px, 25px) scale(1.03); }
        }

        /* ── Noise Texture Overlay ──────────────── */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            opacity: 0.025;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
        }

        /* ── Main Container ─────────────────────── */
        .page-wrapper {
            position: relative;
            z-index: 2;
        }

        .container {
            width: min(1040px, 92%);
            margin: 0 auto;
        }

        /* ── Navigation ─────────────────────────── */
        .nav {
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 1rem 0;
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            background: rgba(10, 15, 13, 0.8);
            border-bottom: 1px solid var(--border);
        }

        .nav .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
            color: var(--text-primary);
        }

        .nav-logo {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--accent), #10b981);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 0 20px var(--accent-glow);
        }

        .nav-title {
            font-weight: 800;
            font-size: 1.15rem;
            letter-spacing: -0.02em;
        }

        .nav-links {
            display: flex;
            gap: 0.25rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.45rem 0.9rem;
            border-radius: var(--radius-sm);
            transition: all 0.25s ease;
        }

        .nav-links a:hover {
            color: var(--accent);
            background: var(--accent-glow);
        }

        /* ── Hero Section ───────────────────────── */
        .hero {
            padding: 6rem 0 4rem;
            text-align: center;
            position: relative;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--accent-glow);
            border: 1px solid var(--border);
            border-radius: 999px;
            padding: 0.4rem 1.1rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--accent);
            margin-bottom: 1.5rem;
            letter-spacing: 0.03em;
            animation: fadeInDown 0.8s ease forwards;
        }

        .hero-badge .pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4); }
            50% { opacity: 0.7; box-shadow: 0 0 0 8px rgba(34, 197, 94, 0); }
        }

        h1 {
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 900;
            letter-spacing: -0.04em;
            line-height: 1.1;
            margin-bottom: 1.25rem;
            animation: fadeInUp 0.8s ease 0.1s forwards;
            opacity: 0;
        }

        h1 .gradient-text {
            background: linear-gradient(135deg, var(--accent), #10b981, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        h1 .subtitle-line {
            display: block;
            font-size: clamp(1.1rem, 2.5vw, 1.5rem);
            font-weight: 600;
            color: var(--text-secondary);
            -webkit-text-fill-color: var(--text-secondary);
            letter-spacing: -0.01em;
            margin-top: 0.3rem;
        }

        .hero-description {
            font-size: 1.1rem;
            color: var(--text-secondary);
            max-width: 620px;
            margin: 0 auto 2.5rem;
            animation: fadeInUp 0.8s ease 0.2s forwards;
            opacity: 0;
        }

        .hero-cta {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease 0.3s forwards;
            opacity: 0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent), #10b981);
            color: #021a0a;
            box-shadow: 0 0 30px var(--accent-glow), 0 4px 15px rgba(34, 197, 94, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 40px var(--accent-glow-strong), 0 8px 25px rgba(34, 197, 94, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--text-primary);
            border: 1px solid var(--border);
        }

        .btn-outline:hover {
            border-color: var(--border-hover);
            background: var(--accent-glow);
            transform: translateY(-2px);
        }

        /* ── Section Headings ───────────────────── */
        .section {
            padding: 5rem 0;
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0.75rem;
        }

        .section-label::before {
            content: "";
            width: 20px;
            height: 2px;
            background: var(--accent);
            border-radius: 2px;
        }

        h2 {
            font-size: clamp(1.75rem, 3.5vw, 2.25rem);
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.2;
            margin-bottom: 0.75rem;
        }

        .section-desc {
            color: var(--text-secondary);
            font-size: 1.05rem;
            max-width: 560px;
            margin-bottom: 2.5rem;
        }

        /* ── Problem & Audience Grid ────────────── */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }

        .info-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 2rem;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.35s ease;
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: 1px;
            background: linear-gradient(135deg, transparent 30%, var(--border-hover) 70%, transparent 100%);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity 0.35s ease;
        }

        .info-card:hover::before {
            opacity: 1;
        }

        .info-card:hover {
            background: var(--bg-card-hover);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .info-card-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 1.25rem;
            position: relative;
        }

        .info-card-icon.problema {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(239, 68, 68, 0.05));
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .info-card-icon.publico {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(59, 130, 246, 0.05));
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .info-card h3 {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 0.6rem;
            letter-spacing: -0.01em;
        }

        .info-card p {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.7;
        }

        /* ── Features ───────────────────────────── */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
        }

        .feature-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 2rem 1.5rem;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.35s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
            opacity: 0;
            transition: opacity 0.35s ease;
        }

        .feature-card:hover {
            background: var(--bg-card-hover);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .feature-card:hover::after {
            opacity: 1;
        }

        .feature-icon {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 1.25rem;
            background: var(--accent-glow);
            border: 1px solid var(--border);
        }

        .feature-card h3 {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: -0.01em;
        }

        .feature-card p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.65;
        }

        /* ── Endpoints Section ──────────────────── */
        .endpoints-section {
            background: var(--bg-secondary);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            position: relative;
        }

        .endpoints-section::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 50% 0%, var(--accent-glow) 0%, transparent 60%);
            pointer-events: none;
        }

        .endpoints-grid {
            display: grid;
            gap: 0.75rem;
        }

        .endpoint-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            text-decoration: none;
            color: var(--text-primary);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .endpoint-card::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--accent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .endpoint-card:hover {
            background: var(--bg-card-hover);
            border-color: var(--border-hover);
            transform: translateX(6px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .endpoint-card:hover::before {
            opacity: 1;
        }

        .method-tag {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 52px;
            padding: 0.3rem 0.65rem;
            background: linear-gradient(135deg, var(--accent), #10b981);
            color: #021a0a;
            font-size: 0.7rem;
            font-weight: 800;
            border-radius: 8px;
            letter-spacing: 0.05em;
            flex-shrink: 0;
        }

        .endpoint-info {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .endpoint-path {
            font-family: "Cascadia Code", "Fira Code", "JetBrains Mono", "Consolas", monospace;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--accent);
            white-space: nowrap;
        }

        .endpoint-desc {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .endpoint-arrow {
            color: var(--text-muted);
            font-size: 1.1rem;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .endpoint-card:hover .endpoint-arrow {
            color: var(--accent);
            transform: translateX(4px);
        }

        /* ── Footer ─────────────────────────────── */
        .footer {
            padding: 3rem 0;
            text-align: center;
            border-top: 1px solid var(--border);
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-primary);
        }

        .footer-brand-icon {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, var(--accent), #10b981);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
        }

        .footer-text {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .footer-divider {
            width: 40px;
            height: 2px;
            background: var(--border);
            border-radius: 2px;
        }

        .footer-tech {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .tech-badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.7rem;
            border-radius: 999px;
            background: var(--accent-glow);
            color: var(--text-secondary);
            border: 1px solid var(--border);
        }

        /* ── Animations ─────────────────────────── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }

        /* ── Responsive ─────────────────────────── */
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .nav-links {
                display: none;
            }

            .hero {
                padding: 4rem 0 3rem;
            }

            .section {
                padding: 3.5rem 0;
            }

            .endpoint-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }

            .endpoint-desc {
                display: block;
            }
        }

        @media (max-width: 480px) {
            .hero-cta {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <!-- Ambient Background Orbs -->
    <div class="ambient-bg" aria-hidden="true">
        <div class="ambient-orb"></div>
        <div class="ambient-orb"></div>
        <div class="ambient-orb"></div>
    </div>

    <div class="page-wrapper">

        <!-- ── Navigation ──────────────────────── -->
        <nav class="nav" id="nav-top">
            <div class="container">
                <a href="#" class="nav-brand">
                    <div class="nav-logo" aria-hidden="true">♻️</div>
                    <span class="nav-title">EcoJac</span>
                </a>
                <ul class="nav-links">
                    <li><a href="#sobre">Sobre</a></li>
                    <li><a href="#funcionalidades">Funcionalidades</a></li>
                    <li><a href="#endpoints">API</a></li>
                </ul>
            </div>
        </nav>

        <!-- ── Hero Section ────────────────────── -->
        <header class="hero" id="inicio">
            <div class="container">
                <div class="hero-badge">
                    <span class="pulse-dot"></span>
                    Projeto de TCC — API Laravel
                </div>

                <h1>
                    <span class="gradient-text">EcoJac</span>
                    <span class="subtitle-line">Descarte Correto do Lixo Seletivo</span>
                </h1>

                <p class="hero-description">
                    Uma API REST pública com informações sobre coleta seletiva, 
                    pontos de descarte, dicas de higienização e guia completo de 
                    materiais recicláveis para a cidade de Jacareí.
                </p>

                <div class="hero-cta">
                    <a href="#endpoints" class="btn btn-primary">
                        <span>🔗</span> Explorar Endpoints
                    </a>
                    <a href="#sobre" class="btn btn-outline">
                        <span>📖</span> Saiba mais
                    </a>
                </div>
            </div>
        </header>

        <!-- ── Sobre: Problema & Público ───────── -->
        <section class="section" id="sobre">
            <div class="container">
                <div class="section-label reveal">Sobre o Projeto</div>
                <h2 class="reveal">Por que o EcoJac existe?</h2>
                <p class="section-desc reveal">
                    Entenda o contexto do problema e quem se beneficia com esta solução.
                </p>

                <div class="info-grid">
                    <article class="info-card reveal reveal-delay-1">
                        <div class="info-card-icon problema" aria-hidden="true">⚠️</div>
                        <h3>O Problema</h3>
                        <p>
                            Muitos moradores de Jacareí ainda não sabem onde 
                            descartar corretamente seus resíduos recicláveis. A falta 
                            de informação acessível sobre ecopontos, tipos de 
                            materiais aceitos e boas práticas de higienização resulta 
                            em contaminação de recicláveis e sobrecarga de aterros 
                            sanitários.
                        </p>
                    </article>

                    <article class="info-card reveal reveal-delay-2">
                        <div class="info-card-icon publico" aria-hidden="true">👥</div>
                        <h3>Público-alvo</h3>
                        <p>
                            Moradores da região, instituições de ensino, comércios 
                            locais e cooperativas de reciclagem que buscam 
                            orientação prática e centralizada sobre coleta seletiva 
                            — desde a separação correta até a localização dos 
                            ecopontos mais próximos.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        <!-- ── Funcionalidades ─────────────────── -->
        <section class="section" id="funcionalidades">
            <div class="container">
                <div class="section-label reveal">Funcionalidades</div>
                <h2 class="reveal">O que a API oferece</h2>
                <p class="section-desc reveal">
                    Três pilares de informação para facilitar o descarte seletivo consciente.
                </p>

                <div class="features-grid">
                    <article class="feature-card reveal reveal-delay-1">
                        <div class="feature-icon" aria-hidden="true">📍</div>
                        <h3>Pontos de Coleta</h3>
                        <p>
                            Localização de ecopontos e cooperativas de reciclagem 
                            em Jacareí, com endereço, coordenadas geográficas, 
                            materiais aceitos e horários de funcionamento.
                        </p>
                    </article>

                    <article class="feature-card reveal reveal-delay-2">
                        <div class="feature-icon" aria-hidden="true">🧹</div>
                        <h3>Dicas de Higienização</h3>
                        <p>
                            Orientações práticas sobre como preparar embalagens 
                            antes do descarte — enxágue, secagem, compactação e 
                            separação de componentes para garantir a reciclagem.
                        </p>
                    </article>

                    <article class="feature-card reveal reveal-delay-3">
                        <div class="feature-icon" aria-hidden="true">🎨</div>
                        <h3>Guia de Materiais</h3>
                        <p>
                            Catálogo completo dos materiais recicláveis com as 
                            cores oficiais das lixeiras seletivas, exemplos do 
                            dia a dia e dicas específicas para cada tipo de resíduo.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        <!-- ── Endpoints ───────────────────────── -->
        <section class="section endpoints-section" id="endpoints">
            <div class="container">
                <div class="section-label reveal">Documentação</div>
                <h2 class="reveal">Endpoints da API</h2>
                <p class="section-desc reveal">
                    Todos os endpoints são públicos e retornam dados em formato JSON. 
                    Clique para testar diretamente no navegador.
                </p>

                <div class="endpoints-grid">
                    <a href="/api/status" target="_blank" rel="noopener" class="endpoint-card reveal reveal-delay-1" id="endpoint-status">
                        <span class="method-tag">GET</span>
                        <div class="endpoint-info">
                            <span class="endpoint-path">/api/status</span>
                            <span class="endpoint-desc">Verifica se a API está online e retorna versão do projeto</span>
                        </div>
                        <span class="endpoint-arrow" aria-hidden="true">→</span>
                    </a>

                    <a href="/api/pontos-de-coleta" target="_blank" rel="noopener" class="endpoint-card reveal reveal-delay-1" id="endpoint-pontos">
                        <span class="method-tag">GET</span>
                        <div class="endpoint-info">
                            <span class="endpoint-path">/api/pontos-de-coleta</span>
                            <span class="endpoint-desc">Lista ecopontos com endereço, coordenadas e materiais aceitos</span>
                        </div>
                        <span class="endpoint-arrow" aria-hidden="true">→</span>
                    </a>

                    <a href="/api/dicas-higienizacao" target="_blank" rel="noopener" class="endpoint-card reveal reveal-delay-2" id="endpoint-dicas">
                        <span class="method-tag">GET</span>
                        <div class="endpoint-info">
                            <span class="endpoint-path">/api/dicas-higienizacao</span>
                            <span class="endpoint-desc">Dicas práticas de higienização de embalagens antes do descarte</span>
                        </div>
                        <span class="endpoint-arrow" aria-hidden="true">→</span>
                    </a>

                    <a href="/api/materiais-reciclaveis" target="_blank" rel="noopener" class="endpoint-card reveal reveal-delay-3" id="endpoint-materiais">
                        <span class="method-tag">GET</span>
                        <div class="endpoint-info">
                            <span class="endpoint-path">/api/materiais-reciclaveis</span>
                            <span class="endpoint-desc">Guia completo de materiais recicláveis com cores das lixeiras</span>
                        </div>
                        <span class="endpoint-arrow" aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- ── Footer ──────────────────────────── -->
        <footer class="footer">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-brand">
                        <div class="footer-brand-icon" aria-hidden="true">♻️</div>
                        <span>EcoJac</span>
                    </div>
                    <div class="footer-divider"></div>
                    <p class="footer-text">
                        Projeto de TCC &middot; Descarte correto do lixo seletivo &middot; {{ date('Y') }}
                    </p>
                    <div class="footer-tech">
                        <span class="tech-badge">Laravel</span>
                        <span class="tech-badge">API REST</span>
                        <span class="tech-badge">JSON</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- ── Scroll Reveal Script ────────────────── -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const reveals = document.querySelectorAll('.reveal');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.15,
                rootMargin: '0px 0px -40px 0px'
            });

            reveals.forEach(el => observer.observe(el));

            // Smooth scroll for nav links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });
        });
    </script>
</body>
</html>
