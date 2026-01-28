import { Controller } from '@hotwired/stimulus';

/**
 * Auto Submit Controller
 * Automatically submits form on input change (useful for filters, search)
 * 
 * Usage:
 * <form data-controller="autosubmit" data-autosubmit-delay-value="500">
 *   <input type="text" data-action="input->autosubmit#submit">
 * </form>
 */
export default class extends Controller {
    static values = { delay: Number };

    connect() {
        this.timeout = null;
    }

    submit() {
        clearTimeout(this.timeout);
        
        this.timeout = setTimeout(() => {
            this.element.requestSubmit();
        }, this.delayValue || 500);
    }
}
