import { Controller } from '@hotwired/stimulus';

/**
 * Modal Controller
 * Handles modal dialogs with backdrop and close functionality
 * 
 * Usage:
 * <div data-controller="modal" data-modal-open-value="false">
 *   <button data-action="click->modal#open">Open Modal</button>
 *   <div data-modal-target="backdrop" class="hidden">...</div>
 *   <div data-modal-target="content" class="hidden">Modal content</div>
 * </div>
 */
export default class extends Controller {
    static targets = ['backdrop', 'content'];
    static values = { open: Boolean };

    connect() {
        this.close();
        this.boundCloseOnEscape = this.closeOnEscape.bind(this);
        document.addEventListener('keydown', this.boundCloseOnEscape);
    }

    open(event) {
        if (event) event.preventDefault();
        this.openValue = true;
        this.backdropTarget.classList.remove('hidden');
        this.contentTarget.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    close(event) {
        if (event) event.preventDefault();
        this.openValue = false;
        this.backdropTarget.classList.add('hidden');
        this.contentTarget.classList.add('hidden');
        document.body.style.overflow = '';
    }

    closeOnEscape(event) {
        if (event.key === 'Escape' && this.openValue) {
            this.close();
        }
    }

    disconnect() {
        document.removeEventListener('keydown', this.boundCloseOnEscape);
        document.body.style.overflow = '';
    }
}
