import { Controller } from '@hotwired/stimulus';

/** Toggles mobile nav panel. Close on link click or outside click. */
export default class extends Controller {
    static targets = ['panel'];

    toggle() {
        this.panelTarget.classList.toggle('hidden');
        this.element.classList.toggle('mobile-nav-open', !this.panelTarget.classList.contains('hidden'));
    }

    close() {
        this.panelTarget.classList.add('hidden');
        this.element.classList.remove('mobile-nav-open');
    }
}
