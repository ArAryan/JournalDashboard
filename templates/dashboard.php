<?php
/* START: Universal Dashboard View */
$manuscripts = $msController->getManuscriptsForDashboard();
?>

<header class="ui-page-header">
    <div class="ui-stack-row">
        <div>
            <h1 class="ui-heading-hero">Author Dashboard</h1>
            <p class="ui-text-p">Welcome to the Editorial Manager. Select an action below to manage your manuscripts.</p>
        </div>
        <div class="ui-badge-indigo">Status: Active Author</div>
    </div>
</header>

<div class="ui-layout-main">
    <div class="ui-grid-canvas">
        <section class="ui-card ui-layout-full ui-page-section">
            <?php if (empty($manuscripts)): ?>
                <p class="ui-text-p">No manuscripts found. Start your first submission.</p>
            <?php else: ?>
                <div class="ui-grid-canvas">
                    <?php foreach ($manuscripts as $ms): ?>
                        <article class="ui-card ui-col-6">
                            <header class="ui-card-header">
                                <span class="ui-label-meta">ID: <?php echo substr($ms['id'], 0, 8); ?></span>
                                <span class="ui-badge-indigo"><?php echo str_replace('_', ' ', $ms['status']); ?></span>
                            </header>
                            <div class="ui-card-body">
                                <h3 class="ui-heading-card"><?php echo $ms['title']; ?></h3>
                                <p class="ui-text-p-compact">Last updated: <?php echo date('M d, Y', strtotime($ms['updated_at'])); ?></p>
                            </div>
                            <footer class="ui-card-footer">
                                <button class="ui-btn-secondary">View Details</button>
                                <button class="ui-btn-primary">Continue</button>
                            </footer>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>
</div>

<aside class="ui-layout-side">
    <section class="ui-card">
        <header class="ui-card-header">
            <h3 class="ui-heading-card-compact">Quick Actions</h3>
        </header>
        <div class="ui-card-body ui-stack-y-4">
            <a href="/JournalDB/public/submit" class="ui-btn-primary ui-btn-full">
                Submit New Manuscript
            </a>
            <button class="ui-btn-secondary ui-btn-full">
                Request Extension
            </button>
        </div>
    </section>
</aside>

<?php
/* END: Universal Dashboard View */
?>
