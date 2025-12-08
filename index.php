<?php
// index.php
// Self-contained Amazon Prime-style streaming mockup (fictional content only)
// No external assets required. Drop this file into a PHP-enabled server and open in browser.

$hero = [
    'title' => 'The Midnight Courier',
    'subtitle' => 'A race against time through neon streets.',
    'bg' => 'data:image/svg+xml;utf8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="1920" height="1080" viewBox="0 0 1920 1080"><defs><linearGradient id="g" x1="0" x2="1"><stop offset="0" stop-color="#141414"/><stop offset="1" stop-color="#00121a"/></linearGradient></defs><rect width="100%" height="100%" fill="url(#g)"/><g fill-opacity="0.08" fill="#fff"><circle cx="1600" cy="200" r="220"/><rect x="200" y="700" width="1400" height="300" rx="30"/></g><text x="120" y="340" font-size="48" fill="#00e6ff" font-family="Arial, Helvetica, sans-serif">THE MIDNIGHT COURIER</text></svg>')
];

// sample carousels with fictional thumbnails
$carousels = [
    ['title' => 'Trending Now', 'items' => range(1,10)],
    ['title' => 'New Releases', 'items' => range(11,20)],
    ['title' => 'Recommended for You', 'items' => range(21,30)],
];

function thumbSvg($id, $title) {
    $color1 = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    $color2 = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    $svg = "<svg xmlns='http://www.w3.org/2000/svg' width='400' height='225' viewBox='0 0 400 225'>";
    $svg .= "<defs><linearGradient id='g$id' x1='0' x2='1'><stop offset='0' stop-color='$color1'/><stop offset='1' stop-color='$color2'/></linearGradient></defs>";
    $svg .= "<rect width='100%' height='100%' rx='6' fill='url(#g$id)'/>";
    $svg .= "<rect x='10' y='140' rx='4' width='220' height='60' fill='rgba(0,0,0,0.35)'/>";
    $svg .= "<text x='22' y='180' font-family='Arial' font-size='18' fill='#fff'>{$title}</text>";
    $svg .= "</svg>";
    return 'data:image/svg+xml;utf8,' . rawurlencode($svg);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Prime-style Mockup — index.php</title>
    <style>
        :root{
            --bg:#0b0f14; --card:#0f1720; --muted:#9aa4ad; --accent:#00e6ff;
            --glass: rgba(255,255,255,0.04);
        }
        *{box-sizing:border-box}
        html,body{height:100%;margin:0;font-family:Inter,Roboto,Arial,sans-serif;background:linear-gradient(180deg,#050608 0%, #071018 100%);color:#e6eef3}
        .app{min-height:100vh;display:flex;flex-direction:column}
        header{display:flex;align-items:center;justify-content:space-between;padding:18px 28px;background:linear-gradient(180deg,rgba(0,0,0,0.35),transparent);position:sticky;top:0;z-index:40}
        .brand{display:flex;align-items:center;gap:12px}
        .logo{width:52px;height:28px;border-radius:4px;background:linear-gradient(90deg,var(--accent),#6defff);display:flex;align-items:center;justify-content:center;font-weight:700;color:#021}
        .nav{display:flex;gap:18px;align-items:center}
        .icon{width:40px;height:40px;border-radius:8px;background:var(--glass);display:inline-flex;align-items:center;justify-content:center;cursor:pointer}
        .search{display:flex;align-items:center;background:rgba(255,255,255,0.03);padding:8px;border-radius:8px;gap:8px}
        .search input{background:transparent;border:0;color:var(--muted);outline:none;width:220px}
        main{flex:1}
        .hero{position:relative;height:56vh;min-height:360px;display:flex;align-items:flex-end;padding:36px 48px;background-size:cover;background-position:center}
        .hero::after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,rgba(2,6,11,0) 30%, rgba(2,6,11,0.85) 90%);}
        .hero-content{position:relative;z-index:2;max-width:780px}
        .kicker{display:inline-block;padding:6px 10px;border-radius:6px;background:rgba(255,255,255,0.04);color:var(--accent);font-weight:600;font-size:13px}
        h1{margin:14px 0 8px;font-size:36px;letter-spacing:0.4px}
        p.sub{color:var(--muted);max-width:600px}
        .cta{margin-top:18px;display:flex;gap:12px}
        .btn{padding:12px 18px;border-radius:8px;border:0;cursor:pointer;font-weight:700}
        .btn.play{background:var(--accent);color:#022}
        .btn.info{background:rgba(255,255,255,0.06);color:var(--muted)}

        .container{padding:28px 36px}
        .carousel{margin:18px 0}
        .carousel h3{margin:0 0 10px;font-size:18px}
        .track{display:flex;gap:12px;overflow:auto;padding:6px 2px}
        .card{min-width:220px;flex:0 0 220px;border-radius:8px;overflow:hidden;background:linear-gradient(180deg,rgba(255,255,255,0.02),transparent);box-shadow:0 6px 20px rgba(2,6,11,0.6)}
        .card img{display:block;width:100%;height:124px;object-fit:cover}
        .meta{padding:10px}
        .meta h4{margin:0 0 8px;font-size:15px}
        .meta p{margin:0;color:var(--muted);font-size:13px}

        /* arrows */
        .carousel-wrap{position:relative}
        .arrow{position:absolute;top:50%;transform:translateY(-50%);width:44px;height:44px;border-radius:10px;background:rgba(0,0,0,0.5);display:flex;align-items:center;justify-content:center;cursor:pointer}
        .arrow.left{left:6px}
        .arrow.right{right:6px}

        /* responsive */
        @media (max-width:900px){
            .hero{height:44vh;padding:20px}
            .hero-content h1{font-size:24px}
            .search input{width:120px}
            .card{min-width:160px;flex:0 0 160px}
            .card img{height:90px}
        }

        /* thin scrollbar */
        .track::-webkit-scrollbar{height:8px}
        .track::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.06);border-radius:6px}
    </style>
</head>
<body>
<div class="app">
    <header>
        <div class="brand">
            <div class="logo">PM</div>
            <div style="font-weight:700;letter-spacing:0.4px">Prime Mock</div>
        </div>

        <div class="nav">
            <div class="search" role="search">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden><path d="M21 21l-4.35-4.35" stroke="#9aa4ad" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <input placeholder="Search movies, shows..." aria-label="search">
            </div>
            <div class="icon" title="Notifications">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden><path d="M12 22c1.1 0 1.99-.89 1.99-1.99H10.01C10.01 21.11 10.9 22 12 22zM18 16v-5c0-3.07-1.63-5.64-4.5-6.32V4a1.5 1.5 0 10-3 0v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z" stroke="#cfe9ee" stroke-width="0.4"/></svg>
            </div>
            <div class="icon" title="Profile">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden><path d="M12 12a4 4 0 100-8 4 4 0 000 8zm0 2c-5 0-8 2.5-8 5v1h16v-1c0-2.5-3-5-8-5z" stroke="#cfe9ee" stroke-width="0.4"/></svg>
            </div>
        </div>
    </header>

    <main>
        <section class="hero" style="background-image:url('<?= $hero['bg'] ?>')">
            <div class="hero-content">
                <div class="kicker">Original</div>
                <h1><?= htmlspecialchars($hero['title']) ?></h1>
                <p class="sub"><?= htmlspecialchars($hero['subtitle']) ?></p>
                <div class="cta">
                    <button class="btn play">Play</button>
                    <button class="btn info">More Info</button>
                </div>
            </div>
        </section>

        <section class="container">
            <?php foreach($carousels as $ci => $c): ?>
                <div class="carousel">
                    <div class="carousel-wrap">
                        <h3><?= htmlspecialchars($c['title']) ?></h3>
                        <div class="arrow left" data-target="track-<?= $ci ?>">&#10094;</div>
                        <div class="arrow right" data-target="track-<?= $ci ?>">&#10095;</div>
                        <div id="track-<?= $ci ?>" class="track" tabindex="0">
                            <?php foreach($c['items'] as $i): $title = "Title {$i}"; ?>
                                <div class="card">
                                    <img src="<?= thumbSvg($i, $title) ?>" alt="<?= htmlspecialchars($title) ?>">
                                    <div class="meta">
                                        <h4><?= htmlspecialchars($title) ?></h4>
                                        <p>1h 42m • Action • 2024</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </main>

    <footer style="padding:28px 36px;color:var(--muted);font-size:14px;background:linear-gradient(180deg,transparent,rgba(0,0,0,0.6))">
        © Fictional Media • For mockup/demo purposes only
    </footer>
</div>

<script>
// Simple carousel buttons (scroll by card width)
document.querySelectorAll('.arrow').forEach(btn=>{
    btn.addEventListener('click', ()=>{
        const target = document.getElementById(btn.dataset.target);
        if(!target) return;
        const card = target.querySelector('.card');
        const scrollAmount = card ? card.offsetWidth + 12 : 240;
        if(btn.classList.contains('left')) target.scrollBy({left: -scrollAmount, behavior: 'smooth'});
        else target.scrollBy({left: scrollAmount, behavior: 'smooth'});
    });
});

// keyboard accessibility: arrow keys scroll focused track
document.querySelectorAll('.track').forEach(track=>{
    track.addEventListener('keydown', (e)=>{
        if(e.key === 'ArrowRight') track.scrollBy({left: 240, behavior:'smooth'});
        if(e.key === 'ArrowLeft') track.scrollBy({left: -240, behavior:'smooth'});
    });
});
</script>
</body>
</html>
