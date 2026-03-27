<?php
/* START: Reviewer Portal View */
?>

<header class="ui-page-header">
    <div class="ui-stack-row">
        <div>
            <h1 class="ui-heading-hero">Reviewer Portal</h1>
            <p class="ui-text-p">Invitation to evaluate: <span class="ui-text-highlight">"Artificial Intelligence in Clinical Diagnostics"</span></p>
        </div>
        <div class="ui-badge-warning">Response Due: 48h</div>
    </div>
</header>

<div class="ui-layout-main">
    <section class="ui-card">
        <header class="ui-card-header">
            <h2 class="ui-heading-section">Manuscript Abstract</h2>
            <div class="ui-stack-x-4">
                <span class="ui-label-meta">Type: Original Research</span>
            </div>
        </header>
        <div class="ui-card-body">
            <p class="ui-text-p">This paper explores the integration of deep learning models in radiological imaging workflows...</p>
        </div>
    </section>

    <section class="ui-card">
        <div class="ui-card-body">
            <label class="ui-form-group-flex">
                <input type="checkbox" id="coi-check" class="ui-form-input ui-input-checkbox">
                <span class="ui-text-p-compact">I confirm that I have no financial or personal relationships with the authors or their institutions that could bias my evaluation of this work.</span>
            </label>
        </div>
        <footer class="ui-card-footer">
            <button class="ui-btn-primary">Accept Invitation</button>
            <button class="ui-btn-secondary">Decline</button>
        </footer>
    </section>

    <div class="ui-grid-canvas">
        <section class="ui-card ui-col-6">
            <header class="ui-card-header">
                <h3 class="ui-heading-card-compact">Reviewer Guidelines</h3>
            </header>
            <div class="ui-card-body ui-stack-y-4">
                <div class="ui-stack-row">
                    <span class="ui-text-muted">Deadline for Submission</span>
                    <span class="ui-text-highlight">14 Days</span>
                </div>
                <div class="ui-stack-row">
                    <span class="ui-text-muted">Double-Blind Protocol</span>
                    <span class="ui-badge-indigo">Active</span>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
/* END: Reviewer Portal View */
?>
