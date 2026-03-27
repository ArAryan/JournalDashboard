<?php
/* START: Author Submission Wizard Template */
?>

<div class="wizard-root">
    <form id="multi-step-form" action="/JournalDB/public/submit" method="POST" enctype="multipart/form-data" class="wizard-form">
        <input type="hidden" name="csrf_token" value="<?php echo \App\Utils\CSRF::generateToken(); ?>">
        
        <header class="ui-page-header">
            <div class="ui-stack-row">
                <div>
                    <h1 class="ui-heading-hero">Submit Manuscript</h1>
                    <p class="ui-text-p">Follow the clinical submission protocol to initiate peer review.</p>
                </div>
                <div class="ui-stack-x-4">
                    <div class="ui-form-group-flex">
                        <div class="ui-badge-indigo ui-badge-pill">1</div>
                        <span class="ui-label-meta">Manuscript Info</span>
                    </div>
                    <div class="ui-badge-pill ui-divider"></div>
                    <div class="ui-form-group-flex ui-muted">
                        <div class="ui-badge ui-badge-pill">2</div>
                        <span class="ui-label-meta">File Upload</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="ui-grid-canvas">
            <section class="ui-layout-main" id="step-1">
                <div class="ui-card">
                    <header class="ui-card-header">
                        <h2 class="ui-heading-section">Step 1: Primary Information</h2>
                    </header>
                    <div class="ui-card-body ui-stack-y-4">
                        <div class="ui-form-group">
                            <label class="ui-form-label">Full Manuscript Title</label>
                            <input type="text" name="title" required class="ui-form-input" placeholder="e.g., Deep Learning in Oncology">
                        </div>
                        
                        <div class="ui-form-group">
                            <label class="ui-form-label">Abstract</label>
                            <textarea name="abstract" required rows="6" class="ui-form-input" placeholder="Summarize your research..."></textarea>
                        </div>
                    </div>
                </div>
            </section>

            <section class="ui-layout-main ui-hidden" id="step-2">
                <div class="ui-card">
                    <header class="ui-card-header">
                        <h2 class="ui-heading-section">Step 2: Document Upload</h2>
                    </header>
                    <div class="ui-card-body ui-stack-y-6">
                        <div class="ui-form-group">
                            <label class="ui-form-label">Main Manuscript File (PDF/DOCX)</label>
                            <div class="ui-card ui-card-body-accent ui-text-center border-dashed border-2">
                                <input type="file" name="manuscript_file" id="file-upload" class="ui-hidden" required>
                                <label for="file-upload" class="ui-btn-secondary cursor-pointer">
                                    Select Document
                                </label>
                                <p class="ui-text-muted mt-4" id="file-name">No file selected (Max 20MB)</p>
                            </div>
                        </div>
                        
                        <div class="ui-form-group">
                            <label class="ui-form-label">Cover Letter (Optional)</label>
                            <textarea name="cover_letter" rows="4" class="ui-form-input" placeholder="Message to the editor..."></textarea>
                        </div>
                    </div>
                </div>
            </section>

            <section class="ui-layout-main ui-hidden" id="step-3">
                <div class="ui-card">
                    <header class="ui-card-header">
                        <h2 class="ui-heading-section">Step 3: Ethics & Compliance</h2>
                    </header>
                    <div class="ui-card-body ui-stack-y-6">
                        <div class="ui-form-group">
                            <label class="ui-form-label">Ethics Committee Approval Number</label>
                            <input type="text" name="ethics_id" required class="ui-form-input" placeholder="e.g., IRB-2026-X12">
                            <p class="ui-text-muted mt-2">Required for all human-subject research.</p>
                        </div>
                        
                        <div class="ui-card-body-accent rounded-xl">
                            <label class="ui-form-group-flex mb-0">
                                <input type="checkbox" name="coi_confirmed" required class="ui-form-input ui-input-checkbox">
                                <span class="ui-text-p-compact">I declare no financial or personal relationships that could inappropriately influence this work.</span>
                            </label>
                        </div>
                    </div>
                </div>
            </section>

            <aside class="ui-layout-side">
                <div class="ui-card">
                    <header class="ui-card-header">
                        <h3 class="ui-heading-card-compact">Submission Checkbox</h3>
                    </header>
                    <div class="ui-card-body ui-stack-y-4">
                        <div class="ui-form-group">
                            <label class="ui-form-label">Classification</label>
                            <select name="article_type" class="ui-form-input">
                                <option>Original Research</option>
                                <option>Case Study</option>
                                <option>Review Article</option>
                            </select>
                        </div>
                        <div class="ui-divider"></div>
                        <p class="ui-text-p-compact">Please ensure all author metadata is correct before proceeding.</p>
                    </div>
                </div>
            </aside>
        </div>
        <footer class="wizard-actions">
            <button type="button" id="next-btn" class="btn-primary">Next Step</button>
            <button type="submit" id="submit-btn" class="wizard-submit-btn ui-btn-primary ui-hidden">Submit Manuscript</button>
        </footer>
    </form>
</div>

<?php
/* END: Author Submission Wizard Template */
?>
