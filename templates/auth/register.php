<?php
/* START: User Registration Template */
?>

<div class="ui-layout-auth">
    <section class="ui-card">
        <header class="ui-card-header-flex">
            <h1 class="ui-heading-hero">Create Account</h1>
            <p class="ui-text-p-compact">Join the EDM clinical network.</p>
        </header>

        <div class="ui-card-body">
            <form action="/JournalDB/public/register" method="POST" class="ui-stack-y-4">
                <input type="hidden" name="csrf_token" value="<?php echo \App\Utils\CSRF::generateToken(); ?>">
                
                <div class="ui-form-group">
                    <label class="ui-form-label">Full Name</label>
                    <input type="text" name="full_name" required class="ui-form-input" placeholder="Dr. John Doe">
                </div>

                <div class="ui-form-group">
                    <label class="ui-form-label">Email Address</label>
                    <input type="email" name="email" required class="ui-form-input">
                </div>

                <div class="ui-form-group">
                    <label class="ui-form-label">Password</label>
                    <input type="password" name="password" required class="ui-form-input">
                </div>

                <div class="ui-form-group">
                    <label class="ui-form-label">Select Primary Role</label>
                    <div class="ui-grid-canvas">
                        <label class="ui-btn-secondary ui-col-6">
                            <input type="radio" name="role" value="Author" checked class="ui-hidden">
                            <span class="ui-btn-role-label">Author</span>
                        </label>
                        <label class="ui-btn-secondary ui-col-6">
                            <input type="radio" name="role" value="Reviewer" class="ui-hidden">
                            <span class="ui-btn-role-label">Reviewer</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="ui-btn-primary ui-btn-full">Complete Registration</button>
            </form>
        </div>

        <footer class="ui-card-footer ui-text-center">
            <p class="ui-text-p-compact">Already a member? <a href="/JournalDB/public/login" class="ui-text-accent">Login here</a></p>
        </footer>
    </section>
</div>

<?php
/* END: User Registration Template */
?>
