<?php
function gen($route, $nav){
    if(empty($nav['link'])) return '';
    if (strpos($route, '.') !== false) { $url = 'https://'.$nav['link']; } else { $url = $nav['link']; }
    $html = '<a href="'.$url.'" class="col">
                <div class="card">
                    <i class="bi bi-'.$nav['icon'].' fs-1"></i>
                    <span>'.$nav['label'].'</span>
                </div>
            </a>';
    return $html;
}
?>
<article class="library" id="layout">
    <div class="row row-cols-1 row-cols-md-4 row-cols-lg-6">
        <?php foreach($this->Builder->menu('library', '/library', 1) as $route => $nav): ?>
            <?= gen($route, $nav) ?>
        <?php endforeach; ?>
    </div>
</article>
