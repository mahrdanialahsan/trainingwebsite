import { Controller } from '@hotwired/stimulus';

/**
 * Tabs Controller
 * Handles tab navigation without page reload
 * 
 * Usage:
 * <div data-controller="tabs" data-tabs-active-tab-value="tab1">
 *   <button data-action="click->tabs#switch" data-tabs-target="tab" data-tab-id="tab1">Tab 1</button>
 *   <div data-tabs-target="panel" data-tab-id="tab1">Content 1</div>
 * </div>
 */
export default class extends Controller {
    static targets = ['tab', 'panel'];
    static values = { activeTab: String };

    connect() {
        if (this.activeTabValue) {
            this.switch({ currentTarget: { dataset: { tabId: this.activeTabValue } } });
        }
    }

    switch(event) {
        const tabId = event.currentTarget.dataset.tabId;
        if (!tabId) return;

        // Update active tab value
        this.activeTabValue = tabId;

        // Update tab buttons
        this.tabTargets.forEach(tab => {
            if (tab.dataset.tabId === tabId) {
                tab.classList.add('active', 'bg-brand-primary', 'text-white');
                tab.classList.remove('text-gray-500', 'hover:text-gray-700');
            } else {
                tab.classList.remove('active', 'bg-brand-primary', 'text-white');
                tab.classList.add('text-gray-500', 'hover:text-gray-700');
            }
        });

        // Update panels
        this.panelTargets.forEach(panel => {
            if (panel.dataset.tabId === tabId) {
                panel.classList.remove('hidden');
            } else {
                panel.classList.add('hidden');
            }
        });

        // Dispatch custom event
        this.dispatch('switched', { detail: { tabId } });
    }
}
