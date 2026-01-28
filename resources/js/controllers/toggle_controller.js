import { Controller } from '@hotwired/stimulus';

/**
 * Toggle Controller
 * Simple toggle functionality for show/hide elements
 * 
 * Usage:
 * <button data-controller="toggle" data-action="click->toggle#toggle" data-toggle-target="content">
 *   Toggle
 * </button>
 * <div data-toggle-target="content" class="hidden">Content</div>
 */
export default class extends Controller {
    static targets = ['content'];
    static values = { 
        open: { type: Boolean, default: false },
        class: { type: String, default: 'hidden' }
    };

    connect() {
        this.updateVisibility();
    }

    toggle() {
        this.openValue = !this.openValue;
        this.updateVisibility();
    }

    show() {
        this.openValue = true;
        this.updateVisibility();
    }

    hide() {
        this.openValue = false;
        this.updateVisibility();
    }

    updateVisibility() {
        this.contentTargets.forEach(target => {
            if (this.openValue) {
                target.classList.remove(this.classValue);
            } else {
                target.classList.add(this.classValue);
            }
        });
    }
}
