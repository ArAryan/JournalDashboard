<?php
/* START: Editor Dashboard View */
$manuscripts = $msController->getManuscriptsForDashboard();
$pending_count = count(array_filter($manuscripts, fn($m) => $m['status'] === 'Technical_Check'));
?>

<header class="ui-page-header">
    <div class="ui-stack-row">
        <div>
            <h1 class="ui-heading-hero">Editor-in-Chief Oversight</h1>
            <p class="ui-text-p">Real-time clinical manuscript pipeline management.</p>
        </div>
        <div class="ui-stack-x-4">
            <button class="ui-badge-indigo">Export Analytics</button>
        </div>
    </div>
</header>

<div class="ui-layout-main">
    <div class="ui-grid-canvas">
        <?php foreach ($stats['recent_submissions'] as $item): ?>
            <article class="ui-card ui-col-4">
                <header class="ui-card-header">
                    <span class="ui-label-meta">REF: <?php echo substr($item['id'], 0, 8); ?></span>
                    <span class="ui-badge-indigo"><?php echo str_replace('_', ' ', $item['status']); ?></span>
                </header>
                <div class="ui-card-body">
                    <h3 class="ui-heading-card"><?php echo $item['title']; ?></h3>
                    <div class="ui-form-group">
                        <span class="ui-label-meta">Lead Author</span>
                        <div class="ui-text-highlight"><?php echo $item['author_name']; ?></div>
                    </div>
                </div>
                <footer class="ui-card-footer-grid">
                    <button class="ui-btn-primary">Assign Reviewers</button>
                    <button class="ui-btn-secondary">Quick Reject</button>
                </footer>
            </article>
        <?php endforeach; ?>
    </div>
</div>

<?php
/* END: Editor Dashboard View */
?>
