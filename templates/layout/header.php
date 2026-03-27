<?php
/* START: Global Header Template */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Professional medical manuscript submission and peer-review system. Clinical-grade editorial workflow engine.">
    <meta name="user-role" content="<?php echo $_SESSION['role'] ?? 'Guest'; ?>">
    <title>JournalDB | Editorial Manager Clone</title>
    
    <!-- START: Typography (Outfit) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- END: Typography -->

    <!-- Global Design System -->
    <link rel="stylesheet" href="/JournalDB/src/css/style.css">
</head>
<body class="site-body">
    <!-- START: Navigation Section -->
    <header class="site-header">
        <div class="ui-container ui-page-section-compact">
            <div class="nav-container">
                <div class="header-logo-container">
                    <span class="header-logo-main">
                        EDM<span class="header-logo-sub">CLONE</span>
                    </span>
                </div>
                
                <nav class="nav-links">
                    <a href="/JournalDB/public/dashboard" class="nav-link">Dashboard</a>
                    <a href="/JournalDB/public/submissions" class="nav-link">My Submissions</a>
                    <div class="nav-profile">
                        <span class="nav-link ui-text-accent"><?php echo $_SESSION['user_name']; ?></span>
                        <a href="/JournalDB/public/logout" class="ui-btn-secondary-compact">Sign Out</a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- END: Navigation Section -->

    <!-- START: Main Content Grid -->
    <main class="container">
/* END: Global Header Template */
?>
