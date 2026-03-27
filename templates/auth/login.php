<?php
/* START: User Login Template */
?>

<div class="ui-layout-auth">
    <section class="ui-card">
        <header class="ui-card-header-flex">
            <h1 class="ui-heading-hero">Sign In</h1>
            <p class="ui-text-p-compact">Welcome back to the Editorial Manager.</p>
        </header>

        <div class="ui-card-body">
            <form action="/JournalDB/public/login" method="POST" class="ui-stack-y-4">
                <input type="hidden" name="csrf_token" value="<?php echo \App\Utils\CSRF::generateToken(); ?>">
                
                <div class="ui-form-group">
                    <label class="ui-form-label">Email Address</label>
                    <input type="email" name="email" required class="ui-form-input" placeholder="name@journal.com">
                </div>

                <div class="ui-form-group">
                    <label class="ui-form-label">Password</label>
                    <input type="password" name="password" required class="ui-form-input">
                </div>

                <button type="submit" class="ui-btn-primary ui-btn-full">Sign In</button>
            </form>
        </div>

        <footer class="ui-card-footer ui-text-center">
            <p class="ui-text-p-compact">New to EDM? <a href="/JournalDB/public/register" class="ui-text-accent">Create an account</a></p>
        </footer>
    </section>
</div>

<?php
/* END: User Login Template */
?>
