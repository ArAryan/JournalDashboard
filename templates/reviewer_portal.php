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
            <h2 class="ui-heading-section">Critical Evaluation Form</h2>
        </header>
        <form action="/JournalDB/public/submit-review" method="POST" class="ui-card-body ui-stack-y-8">
            <input type="hidden" name="csrf_token" value="<?php echo \App\Utils\CSRF::generateToken(); ?>">
            <input type="hidden" name="review_token" value="<?php echo $_GET['token'] ?? ''; ?>">

            <div class="ui-grid-canvas">
                <!-- Scoring Metrics -->
                <div class="ui-col-4 ui-form-group">
                    <label class="ui-form-label">Originality (1-5)</label>
                    <select name="originality" class="ui-form-input">
                        <?php for($i=1;$i<=5;$i++) echo "<option value='$i'>$i</option>"; ?>
                    </select>
                </div>
                <div class="ui-col-4 ui-form-group">
                    <label class="ui-form-label">Methodology (1-5)</label>
                    <select name="methodology" class="ui-form-input">
                        <?php for($i=1;$i<=5;$i++) echo "<option value='$i'>$i</option>"; ?>
                    </select>
                </div>
                <div class="ui-col-4 ui-form-group">
                    <label class="ui-form-label">Clinical Impact (1-5)</label>
                    <select name="impact" class="ui-form-input">
                        <?php for($i=1;$i<=5;$i++) echo "<option value='$i'>$i</option>"; ?>
                    </select>
                </div>
            </div>

            <div class="ui-form-group">
                <label class="ui-form-label">Confidential Comments to Editor</label>
                <textarea name="comments_editor" rows="4" class="ui-form-input" placeholder="Hidden from the author..."></textarea>
            </div>

            <div class="ui-form-group">
                <label class="ui-form-label">Comments to Author</label>
                <textarea name="comments_author" rows="6" class="ui-form-input" placeholder="Provide constructive feedback..."></textarea>
            </div>

            <div class="ui-card-body-accent rounded-xl">
                <label class="ui-form-group-flex mb-0">
                    <input type="checkbox" id="coi-check" class="ui-form-input ui-input-checkbox" required>
                    <span class="ui-text-p-compact">I confirm that I have no financial or personal relationships with the authors that could bias my evaluation.</span>
                </label>
            </div>

            <footer class="ui-stack-row pt-8">
                <button type="button" class="ui-btn-secondary">Save Draft</button>
                <button type="submit" id="submit-review-btn" class="ui-btn-primary" disabled>Submit Final Review</button>
            </footer>
        </form>
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
