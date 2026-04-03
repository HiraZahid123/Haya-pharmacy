<?php
$dir = __DIR__;
$files = glob($dir . '/*.php');

foreach ($files as $file) {
    if (basename($file) == 'survey_config.php' || basename($file) == 'results.php') continue;
    
    $content = file_get_contents($file);
    $changed = false;
    
    $css_search1 = '    .nav-btn svg { width: 16px; height: 16px; stroke-width: 2.2; flex-shrink: 0; }';
    $css_replace1 = '    .nav-btn svg { width: 16px; height: 16px; stroke-width: 2.2; flex-shrink: 0; }';
    
    $css_search2 = "    .nav-btn svg {\r\n      width: 15px;\r\n      height: 15px;\r\n      flex-shrink: 0;\r\n    }";
    $css_search3 = "    .nav-btn svg {\n      width: 15px;\n      height: 15px;\n      flex-shrink: 0;\n    }";
    
    if (strpos($content, $css_search1) !== false) {
        $content = str_replace($css_search1, $css_replace1, $content);
        $changed = true;
    }
    if (strpos($content, $css_search2) !== false) {
        $content = str_replace($css_search2, $css_replace1, $content);
        $changed = true;
    }
    if (strpos($content, $css_search3) !== false) {
        $content = str_replace($css_search3, $css_replace1, $content);
        $changed = true;
    }

    $pattern = '/<div class="nav-row">\s*<a href="<\?= getPrevStepUrl\(\) \?>" class="nav-btn prev-btn"(?: id="btn-prev")?>\s*<svg viewBox="0 0 15 15".*?<\/svg>\s*(السؤال السابق|السابق)\s*<\/a>\s*<button type="submit" class="nav-btn next-btn" id="btn-next">\s*(السؤال التالي|التالي)\s*<svg viewBox="0 0 15 15".*?<\/svg>\s*<\/button>\s*<\/div>/is';

    $pattern_inverted = '/<div class="nav-row">\s*<button type="submit" class="nav-btn next-btn" id="btn-next">\s*<svg viewBox="0 0 15 15".*?<\/svg>\s*(السؤال التالي|التالي)\s*<\/button>\s*<a href="<\?= getPrevStepUrl\(\) \?>" class="nav-btn prev-btn"(?: id="btn-prev")?>\s*(السؤال السابق|السابق)\s*<svg viewBox="0 0 15 15".*?<\/svg>\s*<\/a>\s*<\/div>/is';
    
    $replacement_callback = function($matches) {
        $prev_text = trim($matches[1]);
        $next_text = trim($matches[2]);
        
        return '<div class="nav-row">
        <a href="<?= getPrevStepUrl() ?>" class="nav-btn prev-btn" id="btn-prev">
          ' . $prev_text . '
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 18L15 12L9 6" stroke="#015645" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
        <button type="submit" class="nav-btn next-btn" id="btn-next">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 18L9 12L15 6" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          ' . $next_text . '
        </button>
      </div>';
    };

    $replacement_callback_inv = function($matches) {
        $next_text = trim($matches[1]);
        $prev_text = trim($matches[2]);
        
        return '<div class="nav-row">
        <a href="<?= getPrevStepUrl() ?>" class="nav-btn prev-btn" id="btn-prev">
          ' . $prev_text . '
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 18L15 12L9 6" stroke="#015645" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
        <button type="submit" class="nav-btn next-btn" id="btn-next">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 18L9 12L15 6" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          ' . $next_text . '
        </button>
      </div>';
    };

    if (preg_match($pattern, $content)) {
        $content = preg_replace_callback($pattern, $replacement_callback, $content);
        $changed = true;
    } elseif (preg_match($pattern_inverted, $content)) {
        $content = preg_replace_callback($pattern_inverted, $replacement_callback_inv, $content);
        $changed = true;
    }

    if ($changed) {
        file_put_contents($file, $content);
        echo "Updated: " . basename($file) . "\n";
    }
}
echo "Done.\n";
