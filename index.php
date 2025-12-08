<?php
// apple-store-mock.php
// Apple Store (India) inspired single-file PHP mockup for demo purposes.
// This is an original, non-infringing mockup — use for local testing only.

$sections = [
    ['id'=>'mac','title'=>'Mac','items'=>[
        ['sku'=>'MBP14','name'=>'MacBook Pro 14"','price'=>'₹169,900','tag'=>'From'],
        ['sku'=>'MBA','name'=>'MacBook Air','price'=>'₹99,900','tag'=>'From']
    ]],
    ['id'=>'iphone','title'=>'iPhone','items'=>[
        ['sku'=>'IP17','name'=>'iPhone 17','price'=>'₹82,900','tag'=>'From'],
        ['sku'=>'IP17P','name'=>'iPhone 17 Pro','price'=>'₹134,900','tag'=>'From']
    ]],
    ['id'=>'ipad','title'=>'iPad','items'=>[
        ['sku'=>'IPDP','name'=>'iPad Pro','price'=>'₹99,900','tag'=>'From'],
        ['sku'=>'IPD','name'=>'iPad Air','price'=>'₹54,900','tag'=>'From']
    ]]
];

function svgBanner($text){
    $svg = "<svg xmlns='http://www.w3.org/2000/svg' width='1200' height='420' viewBox='0 0 1200 420'>";
    $svg .= "<rect width='100%' height='100%' fill='#f6f7f8'/>";
    $svg .= "<g fill='#111' font-family='Helvetica,Arial' font-weight='700'><text x='60' y='120' font-size='48'>".htmlspecialchars($text)."</text></g>";
    $svg .= "</svg>";
    return 'data:image/svg+xml;utf8,'.rawurlencode($svg);
}

function productCardSvg($name,$price){
    $w=360;$h=220;
    $bg = '#'.dechex(crc32($name) & 0xFFFFFF);
    $svg = "<svg xmlns='http://www.w3.org/2000/svg' width='$w' height='$h' viewBox='0 0 $w $h'>";
    $svg .= "<defs><linearGradient id='g' x1='0' x2='1'><stop offset='0' stop-color='$bg'/><stop offset='1' stop-color='#ffffff'/></linearGradient></defs>";
    $svg .= "<rect width='100%' height='100%' rx='10' fill='url(#g)'/>";
    $svg .= "<text x='20' y='160' font-family='Arial' font-size='18' fill='#111'>".htmlspecialchars($name)."</text>";
    $svg .= "<text x='20' y='190' font-family='Arial' font-size='16' fill='#333'>".htmlspecialchars($price)."</text>";
    $svg .= "</svg>";
    return 'data:image/svg+xml;utf8,'.rawurlencode($svg);
}

// simple route for product detail
if(isset($_GET['product'])){
    $sku = $_GET['product'];
    foreach($sections as $s) foreach($s['items'] as $it) if($it['sku']==$sku){
        header('Content-Type: application/json');
        echo json_encode($it); exit;
    }
    http_response_code(404); echo json_encode(['error'=>'not found']); exit;
}

?>
<!doctype html>
<html lang="en-IN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Apple Store — up (India)</title>
<style>
:root{--bg:#ffffff;--muted:#6b7280;--accent:#0071e3}
*{box-sizing:border-box}
body{margin:0;font-family:San Francisco, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;background:var(--bg);color:#0b0b0b}
.header{display:flex;align-items:center;justify-content:space-between;padding:14px 28px;border-bottom:1px solid #e6e6e6}
.brand{display:flex;align-items:center;gap:12px}
.logo{width:44px;height:24px;border-radius:6px;background:linear-gradient(90deg,var(--accent),#66b9ff);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700}
.nav{display:flex;gap:18px;align-items:center}
.hero{display:flex;gap:28px;align-items:center;padding:36px 28px}
.hero .copy{max-width:720px}
.kicker{font-weight:700;color:var(--accent);font-size:13px}
.h1{font-size:36px;margin:10px 0}
.h2{font-size:22px;margin:0}
.btn{background:var(--accent);border:0;color:#fff;padding:10px 14px;border-radius:8px;cursor:pointer;font-weight:700}
.container{padding:20px 28px}
.section{margin-bottom:28px}
.row{display:flex;gap:12px;overflow:auto;padding:12px 0}
.card{min-width:260px;border:1px solid #ececec;border-radius:10px;padding:12px;background:#fff;flex:0 0 260px}
.card img{width:100%;height:160px;object-fit:cover;border-radius:8px}
.card h3{margin:10px 0 6px;font-size:16px}
.card p{margin:0;color:var(--muted);font-size:14px}
.footer{padding:28px;border-top:1px solid #eee;color:var(--muted);font-size:14px}
@media(max-width:800px){.hero{flex-direction:column;align-items:flex-start}.card{min-width:210px;flex:0 0 210px}}
</style>
</head>
<body>
<header class="header">
    <div class="brand"><div class="logo"></div><div style="font-weight:700">Apple </div></div>
    <nav class="nav">
        <a href="#mac">Mac</a>
        <a href="#iphone">iPhone</a>
        <a href="#ipad">iPad</a>
        <button class="btn" onclick="location.href='#store'">Store</button>
    </nav>
</header>

<main>
    <section class="hero">
        <div class="copy">
            <div class="kicker">The Latest</div>
            <div class="h1">Give something special this season</div>
            <p style="color:var(--muted);max-width:600px">Explore curated gifts, services, and personalized options. Free delivery and pickup available in select locations.</p>
            <div style="margin-top:16px"><button class="btn">Shop the Store</button></div>
        </div>
        <div><img src="<?= svgBanner('Apple Store — up') ?>" alt="banner" style="border-radius:10px;box-shadow:0 8px 30px rgba(10,10,10,0.08)"></div>
    </section>

    <section class="container" id="store">
        <?php foreach($sections as $sec): ?>
            <div class="section" id="<?= htmlspecialchars($sec['id']) ?>">
                <h2 class="h2"><?= htmlspecialchars($sec['title']) ?></h2>
                <div class="row">
                    <?php foreach($sec['items'] as $it): ?>
                        <article class="card" data-sku="<?= htmlspecialchars($it['sku']) ?>">
                            <img src="<?= productCardSvg($it['name'],$it['price']) ?>" alt="<?= htmlspecialchars($it['name']) ?>">
                            <h3><?= htmlspecialchars($it['name']) ?></h3>
                            <p><?= htmlspecialchars($it['tag']) ?> <?= htmlspecialchars($it['price']) ?></p>
                            <p style="margin-top:8px"><button class="btn" onclick="openProduct('<?= $it['sku'] ?>')">Buy</button></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</main>

<footer class="footer">
    <div style="display:flex;justify-content:space-between;align-items:center;gap:18px;flex-wrap:wrap">
        <div>&copy; Fictional Tech — Demo only</div>
        <div style="display:flex;gap:12px">
            <a href="#">Find a Store</a>
            <a href="#">Orders</a>
            <a href="#">Support</a>
        </div>
    </div>
</footer>

<script>
function openProduct(sku){
    fetch('?product='+encodeURIComponent(sku)).then(r=>r.json()).then(j=>{
        alert(j.name + " — " + j.price + "

" + (j.tag||''));
    }).catch(()=>alert('Product not found'));
}
</script>
</body>
</html>
