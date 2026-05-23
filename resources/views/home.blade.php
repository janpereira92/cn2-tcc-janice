<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCC API Hub</title>
    <style>
        :root {
            --bg: #f7f4ef;
            --card: #ffffff;
            --text: #1f2937;
            --muted: #4b5563;
            --primary: #14532d;
            --accent: #b45309;
            --border: #e5e7eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle at top right, #fef3c7 0%, var(--bg) 40%), var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            width: min(980px, 92%);
            margin: 0 auto;
            padding: 2.5rem 0 4rem;
        }

        .hero {
            background: linear-gradient(135deg, #ecfccb 0%, #ffffff 60%);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 2rem;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
        }

        h1, h2 {
            margin: 0 0 0.75rem;
            line-height: 1.25;
        }

        h1 {
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            color: var(--primary);
        }

        h2 {
            font-size: clamp(1.2rem, 2vw, 1.5rem);
            margin-top: 1.4rem;
        }

        p {
            margin: 0.3rem 0 0.8rem;
            color: var(--muted);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 1rem;
            margin-top: 1.1rem;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1rem;
        }

        ul {
            padding-left: 1.1rem;
            margin: 0.5rem 0;
        }

        li + li {
            margin-top: 0.4rem;
        }

        .endpoint-list a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }

        .endpoint-list a:hover {
            text-decoration: underline;
        }

        .badge {
            display: inline-block;
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
            border-radius: 999px;
            font-size: 0.85rem;
            padding: 0.2rem 0.65rem;
            margin-bottom: 0.7rem;
        }
    </style>
</head>
<body>
    <main class="container">
        <section class="hero">
            <span class="badge">Projeto publicado com API Laravel</span>
            <h1>TCC API Hub</h1>
            <p>Uma base de API para apoiar o acompanhamento de projetos de TCC e demonstrar deploy no Render.</p>

            <div class="grid">
                <article class="card">
                    <h2>Problema</h2>
                    <p>Organizar informações de orientação, etapas e acompanhamento de projetos de forma simples e acessível.</p>
                </article>

                <article class="card">
                    <h2>Público-alvo</h2>
                    <p>Estudantes, docentes orientadores e coordenação acadêmica.</p>
                </article>
            </div>

            <article class="card" style="margin-top: 1rem;">
                <h2>Funcionalidades principais</h2>
                <ul>
                    <li>Consulta do status da API em produção.</li>
                    <li>Listagem de projetos e orientadores.</li>
                    <li>Acompanhamento de etapas e entregas do TCC.</li>
                </ul>
            </article>

            <article class="card endpoint-list" style="margin-top: 1rem;">
                <h2>Endpoints da API</h2>
                <ul>
                    <li><a href="/api/status" target="_blank" rel="noopener">/api/status</a></li>
                    <li><a href="/api/projetos" target="_blank" rel="noopener">/api/projetos</a></li>
                    <li><a href="/api/orientadores" target="_blank" rel="noopener">/api/orientadores</a></li>
                    <li><a href="/api/entregas" target="_blank" rel="noopener">/api/entregas</a></li>
                </ul>
            </article>
        </section>
    </main>
</body>
</html>
