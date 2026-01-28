import { Controller } from '@hotwired/stimulus';

/**
 * Loader Controller
 * Shows loading state during form submissions and Turbo navigation
 * 
 * Usage:
 * <form data-controller="loader" data-action="turbo:submit-start->loader#show turbo:submit-end->loader#hide">
 *   <button data-loader-target="button">Submit</button>
 *   <div data-loader-target="spinner" class="hidden">Loading...</div>
 * </form>
 */
export default class extends Controller {
    static targets = ['button', 'spinner', 'content'];

    show() {
        if (this.hasButtonTarget) {
            this.buttonTarget.disabled = true;
            this.buttonTarget.dataset.originalText = this.buttonTarget.textContent;
            this.buttonTarget.textContent = 'Loading...';
        }
        
        if (this.hasSpinnerTarget) {
            this.spinnerTarget.classList.remove('hidden');
        }

        if (this.hasContentTarget) {
            this.contentTarget.classList.add('opacity-50', 'pointer-events-none');
        }
    }

    hide() {
        if (this.hasButtonTarget) {
            this.buttonTarget.disabled = false;
            if (this.buttonTarget.dataset.originalText) {
                this.buttonTarget.textContent = this.buttonTarget.dataset.originalText;
            }
        }

        if (this.hasSpinnerTarget) {
            this.spinnerTarget.classList.add('hidden');
        }

        if (this.hasContentTarget) {
            this.contentTarget.classList.remove('opacity-50', 'pointer-events-none');
        }
    }
}
