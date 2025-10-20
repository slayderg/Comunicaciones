<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Oficina de Comunicaciones')</title>

  <style>
  :root{ --ug-teal:#0a4c56; --ug-teal-2:#0d6b73; --ug-orange:#f37c20; --ug-red:#cc0000; --ug-gray:#f5f7f8; }
  *{box-sizing:border-box}
  html, body{margin:0;height:100%;}
  body{
    font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif;
    background:#fff;color:#111;
    display:flex;flex-direction:column; /* Para usar el footer fijo */
    min-height:100vh;
  }

  .text-orange { color: var(--ug-orange); } /* Color naranja textos */

  /* HEADER */
  .ug-header{background:var(--ug-teal); color:#fff;}
  .ug-topbar{ /* barra superior responsive ancho completo */
    display:flex; justify-content:space-between; align-items:center;
    padding:10px clamp(12px,4vw,40px); width:100%;
  }
  .ug-brand{display:flex;align-items:center;gap:10px;text-decoration:none;color:#fff}
  .ug-brand img{height:44px;display:block;max-width:100%}

  .ug-nav{display:flex;align-items:center;gap:18px;flex-wrap:wrap}
  .ug-nav a{color:#fff;text-decoration:none;font-weight:600;opacity:.95;padding:8px 0}
  .ug-nav a:hover{opacity:1;border-bottom:2px solid var(--ug-orange)}
  .ug-nav a.is-active{opacity:1;border-bottom:3px solid var(--ug-orange)}
  .ug-btn{background:#007b5e;color:#fff;padding:8px 14px;border-radius:8px;text-decoration:none}
  .ug-btn:hover{background:#00664e}

  /* CONTENIDO */
  main.ug-container{
    flex:1; /* <--- hace que el contenido empuje el footer hacia abajo */
    padding:20px clamp(12px,4vw,40px);
    max-width:1200px; margin:0 auto; width:100%;
  }

  /* COMPONENTES */
  .ug-title{color:var(--ug-red); font-size:40px; margin:20px 0}
  .ug-card{background:#fff;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.06);padding:18px;border-left:5px solid var(--ug-orange)}
  .ug-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:18px}
  .ug-muted{color:#5f6b6f}
  .ug-link{color:var(--ug-teal-2);text-decoration:none}
  .ug-link:hover{color:var(--ug-red);text-decoration:underline}

  /* FORMULARIOS */
  .form-wrap{max-width:900px;margin:28px 0}
  .form-group{margin-bottom:14px}
  .form-group label{display:block;font-weight:600;margin-bottom:6px}
  .form-control{width:100%;padding:10px 12px;border:1px solid #cfd8dc;border-radius:8px;font-size:16px}
  .form-actions{display:flex;gap:10px;margin-top:10px}
  .btn-primary{background:#007b5e;color:#fff;border:0;border-radius:8px;padding:10px 16px;cursor:pointer}
  .btn-primary:hover{background:#00664e}
  .btn-link{color:#0d6b73;text-decoration:none;padding:10px 0}
  .btn-link:hover{text-decoration:underline}

  /* FOOTER */
  footer{background:var(--ug-gray);border-top:4px solid var(--ug-orange);}
  .ug-footer{
    display:flex;justify-content:space-between;align-items:center;
    padding:20px clamp(12px,4vw,40px); color:#0a4c56; font-weight:500; font-size:15px;
  }

  /* Responsive tweaks */
  @media (max-width:640px){
    .ug-title{font-size:32px}
    .form-wrap{max-width:100%}
    .ug-footer{flex-direction:column;gap:10px;text-align:center}
  }
  </style>
</head>
<body>

  <!-- HEADER -->
  <header class="ug-header">
    <div class="ug-topbar">
      {{-- Marca / Inicio --}}
      <a class="ug-brand" href="{{ route('noticias.index') }}">
        <img src="{{ asset('img/logo-uniguajira.png') }}" alt="Universidad de La Guajira">
        <strong>Oficina de Comunicaciones</strong>
      </a>

      {{-- Módulos --}}
      <nav class="ug-nav">
      <a href="{{ route('noticias.index') }}"
     class="{{ request()->routeIs('noticias.*') ? 'is-active' : '' }}">
     Noticias
  </a>

  <a href="{{ route('estrategias.index') }}"
     class="{{ request()->routeIs('estrategias.*') ? 'is-active' : '' }}">
     Estrategias
  </a>


  <a href="{{ route('acciones.index') }}"
     class="{{ request()->routeIs('acciones.*') ? 'is-active' : '' }}">
     Acciones
  </a>

 
        {{-- Más módulos cuando estén listos --}}
        {{-- <a href="{{ url('/laravel/sistema_comunicaciones/public/acciones') }}" class="{{ request()->routeIs('acciones.*') ? 'is-active' : '' }}">Acciones</a> --}}
        {{-- <a href="{{ url('/laravel/sistema_comunicaciones/public/seguimientos') }}" class="{{ request()->routeIs('seguimientos.*') ? 'is-active' : '' }}">Seguimientos</a> --}}
        {{-- <a href="{{ url('/laravel/sistema_comunicaciones/public/evidencias') }}" class="{{ request()->routeIs('evidencias.*') ? 'is-active' : '' }}">Evidencias</a> --}}

        {{-- Botón Crear SOLO en Noticias --}}

        {{-- @if (request()->routeIs('noticias.*'))
          <a href="{{ route('noticias.create') }}" class="ug-btn" style="margin-left:10px;">Crear</a>
        @endif */--}}

      
        {{-- Botón Crear SOLO en Estrategias --}} 
        @if (request()->routeIs('estrategias.*'))
            <a href="{{ route('areas.index') }}" 
            class="{{ request()->routeIs('areas.*') ? 'is-active' : '' }}">
            Areas
          </a>

        @endif
      </nav>
    </div>
  </header>

  <!-- CONTENIDO -->
  <main class="ug-container">
    @yield('content')
  </main>

  <!-- FOOTER -->
  <footer>
    <div class="ug-footer">
      <span>© {{ date('Y') }} Universidad de La Guajira — Oficina de Comunicaciones</span>
      <a href="https://uniguajira.edu.co" target="_blank" rel="noopener" class="ug-link" style="font-weight:600;">
        uniguajira.edu.co
      </a>
    </div>
  </footer>

</body>
</html>
