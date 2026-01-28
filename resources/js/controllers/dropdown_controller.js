import { Controller } from '@hotwired/stimulus';

/**
 * Dropdown Controller
 * Handles dropdown menus with click-outside-to-close functionality
 * 
 * Usage:
 * <div data-controller="dropdown" data-dropdown-open-value="false">
 *   <button data-action="click->dropdown#toggle">Toggle</button>
 *   <div data-dropdown-target="menu" class="hidden">Menu content</div>
 * </div>
 */
export default class extends Controller {
    static targets = ['menu'];
    static values = { open: Boolean };

    connect() {
        this.close();
        // Close on outside click
        this.boundCloseOnOutsideClick = this.closeOnOutsideClick.bind(this);
        document.addEventListener('click', this.boundCloseOnOutsideClick);
    }

    disconnect() {
        document.removeEventListener('click', this.boundCloseOnOutsideClick);
    }

    toggle(event) {
        event.stopPropagation();
        this.openValue ? this.close() : this.open();
    }

    open() {
        this.openValue = true;
        this.menuTarget.classList.remove('hidden', 'opacity-0', 'invisible');
        this.menuTarget.classList.add('opacity-100', 'visible');
    }

    close() {
        this.openValue = false;
        this.menuTarget.classList.add('hidden', 'opacity-0', 'invisible');
        this.menuTarget.classList.remove('opacity-100', 'visible');
    }

    closeOnOutsideClick(event) {
        if (!this.element.contains(event.target) && this.openValue) {
            this.close();
        }
    }
}
