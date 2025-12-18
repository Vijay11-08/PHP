<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Assume $pageTitle is set before including, or use default
$title = isset($pageTitle) ? $pageTitle : 'Placement Portal';
$path_adjust = isset($pathAdjust) ? $pathAdjust : '../'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="<?php echo $path_adjust; ?>assets/style.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container <?php echo (isset($isPublicPage) && $isPublicPage) ? 'public-layout' : ''; ?>">
