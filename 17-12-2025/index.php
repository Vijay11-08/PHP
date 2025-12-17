<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Learning Hub - 17 Dec 2025</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; background-color: #f4f4f4; }
        h1 { text-align: center; color: #333; }
        .file-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; }
        .file-card { background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); transition: transform 0.2s; }
        .file-card:hover { transform: translateY(-3px); }
        .file-card a { text-decoration: none; color: #007bff; font-weight: bold; display: block; }
        .file-card p { font-size: 0.85em; color: #666; margin-top: 5px; }
    </style>
</head>
<body>
    <h1>PHP Topics (Deep Dive)</h1>
    <div class="file-list">
        <?php
        $files = scandir(__DIR__);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && $file !== 'index.php' && str_ends_with($file, '.php')) {
                // Formatting the name for display (e.g., 01_syntax_comments.php -> 01 Syntax Comments)
                $displayName = ucwords(str_replace(['_', '.php'], [' ', ''], $file));
                echo "<div class='file-card'>
                        <a href='$file'>$displayName</a>
                        <p>Click to view examples</p>
                      </div>";
            }
        }
        ?>
    </div>
</body>
</html>
