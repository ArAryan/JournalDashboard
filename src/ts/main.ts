/* START: Advanced TypeScript Core for Editorial Manager */

/**
 * Interface for Manuscript Data
 */
interface Manuscript {
    id: number;
    title: string;
    status: string;
    updatedAt: Date;
}

/**
 * Abstract Dashboard Controller with Generic Support
 */
abstract class Dashboard<T> {
    protected items: T[] = [];

    constructor(public role: string) {
        console.log(`[START: Dashboard Initialization] Role: ${role}`);
    }

    abstract render(): void;

    public addItem(item: T): void {
        this.items.push(item);
        console.log(`[ACTION: Item Added]`, item);
    }
}

/**
 * Specific implementation for Author Dashboard
 */
class AuthorDashboard extends Dashboard<Manuscript> {
    render(): void {
        console.log("[START: Render Author Interface]");
        const container = document.querySelector('.manuscript-grid');
        if (container) {
            container.innerHTML = this.items.map(ms => `
                <div class="dashboard-card" id="ms-${ms.id}">
                    <h3 class="text-xl font-bold">${ms.title}</h3>
                    <p class="text-sm text-slate-500">Status: ${ms.status}</p>
                </div>
            `).join('');
        }
        console.log("[END: Render Author Interface]");
    }
}

/**
 * Multi-step Wizard Controller
 */
class MultiStepWizard {
    private currentStep: number = 1;
    private maxSteps: number = 2; // Updated to match template

    constructor() {
        console.log("[START: Wizard Initialization]");
        this.initListeners();
    }

    private initListeners(): void {
        const nextBtn = document.getElementById('next-btn');
        const fileInput = document.getElementById('file-upload') as HTMLInputElement;

        if (nextBtn) {
            nextBtn.addEventListener('click', () => this.nextStep());
        }

        if (fileInput) {
            fileInput.addEventListener('change', () => {
                const fileNameEl = document.getElementById('file-name');
                if (fileNameEl && fileInput.files && fileInput.files[0]) {
                    fileNameEl.textContent = `Selected: ${fileInput.files[0].name}`;
                    fileNameEl.classList.remove('ui-text-muted');
                    fileNameEl.classList.add('ui-text-accent');
                }
            });
        }
    }

    private nextStep(): void {
        console.log(`[ACTION: Transitioning Step] ${this.currentStep} -> ${this.currentStep + 1}`);
        
        // Hide current step
        const currentEl = document.getElementById(`step-${this.currentStep}`);
        if (currentEl) currentEl.classList.add('ui-hidden');

        this.currentStep++;

        // Show next step
        const nextEl = document.getElementById(`step-${this.currentStep}`);
        if (nextEl) nextEl.classList.remove('ui-hidden');

        // Toggle buttons if on last step
        if (this.currentStep === this.maxSteps) {
            const nextBtn = document.getElementById('next-btn');
            const submitBtn = document.getElementById('submit-btn');
            if (nextBtn) nextBtn.classList.add('ui-hidden');
            if (submitBtn) submitBtn.classList.remove('ui-hidden');
        }

        // Update Progress Tracker (if exists)
        const indicators = document.querySelectorAll('.ui-badge-pill');
        if (indicators[this.currentStep - 1]) {
            indicators[this.currentStep - 1].classList.remove('ui-muted');
            indicators[this.currentStep - 1].classList.add('ui-badge-indigo');
        }
    }
}

/**
 * Reviewer Portal Controller
 */
class ReviewerPortal {
    constructor() {
        console.log("[START: Reviewer Portal Init]");
        this.initCOIGate();
    }

    private initCOIGate(): void {
        const checkbox = document.getElementById('coi-check') as HTMLInputElement;
        const acceptBtn = document.getElementById('accept-review-btn') as HTMLButtonElement;

        if (checkbox && acceptBtn) {
            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    acceptBtn.disabled = false;
                    acceptBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                } else {
                    acceptBtn.disabled = true;
                    acceptBtn.classList.add('opacity-50', 'cursor-not-allowed');
                }
            });
        }
    }
}

// Initialize Application
document.addEventListener('DOMContentLoaded', () => {
    /* START: Application Bootstrap */
    const appRoleMeta = document.querySelector('meta[name="user-role"]');
    const role = appRoleMeta ? appRoleMeta.getAttribute('content') : 'Guest';

    // UI Modules
    if (document.getElementById('multi-step-form')) new MultiStepWizard();
    if (document.getElementById('coi-check')) new ReviewerPortal();

    if (role === 'Author') {
        const dashboard = new AuthorDashboard(role);
        dashboard.addItem({ id: 101, title: 'Impact of AI on Medicine', status: 'Submitted', updatedAt: new Date() });
        dashboard.render();
    }
    /* END: Application Bootstrap */
});

/* END: Advanced TypeScript Core */
