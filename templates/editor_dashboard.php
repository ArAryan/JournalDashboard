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
            <article class="ui-card ui-glassmorphism ui-col-4">
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
                    <?php if ($item['status'] === 'Accepted'): ?>
                        <button class="ui-btn-success ui-btn-full move-production-btn" data-id="<?php echo $item['id']; ?>">
                            Move to Production
                        </button>
                    <?php else: ?>
                        <button class="ui-btn-primary">Assign Reviewers</button>
                        <button class="ui-btn-secondary">Quick Reject</button>
                    <?php endif; ?>
                </footer>
            </article>
        <?php endforeach; ?>
    </div>

    <!-- START: Expert Reviewer Matching -->
    <section class="ui-page-section">
        <header class="ui-page-header">
            <h2 class="ui-heading-section">Expert Reviewer Network</h2>
        </header>
        <div class="ui-grid-canvas">
            <?php 
            $reviewers = $auth->getUsersByRole('Reviewer'); 
            foreach ($reviewers as $rev): 
            ?>
                <article class="ui-card ui-col-4 ui-card-hover">
                    <div class="ui-card-body ui-stack-y-4">
                        <div class="ui-stack-row">
                            <h3 class="ui-heading-card-compact"><?php echo $rev['full_name']; ?></h3>
                            <span class="ui-badge-success">Available</span>
                        </div>
                        <div class="ui-stack-x-4 flex-wrap">
                            <?php 
                            $tags = explode(',', $rev['specialty_tags'] ?? 'General Medicine');
                            foreach($tags as $tag): 
                            ?>
                                <span class="ui-label-meta bg-slate-100 px-2 py-1 rounded"><?php echo trim($tag); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <footer class="ui-card-footer">
                        <button class="ui-btn-secondary-compact ui-btn-full invite-reviewer-btn" data-id="<?php echo $rev['id']; ?>">
                            Send Invitation
                        </button>
                    </footer>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <!-- END: Expert Reviewer Matching -->
</div>

<?php
/* END: Editor Dashboard View */
?>
