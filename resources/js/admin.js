import './bootstrap';
import { Application } from '@hotwired/stimulus';

// Initialize Stimulus (without Turbo)
const application = Application.start();

// Manually register controllers (simpler approach)
import DropdownController from './controllers/dropdown_controller';
import ModalController from './controllers/modal_controller';
import TabsController from './controllers/tabs_controller';
import ToggleController from './controllers/toggle_controller';
import LoaderController from './controllers/loader_controller';
import AutosubmitController from './controllers/autosubmit_controller';

application.register('dropdown', DropdownController);
application.register('modal', ModalController);
application.register('tabs', TabsController);
application.register('toggle', ToggleController);
application.register('loader', LoaderController);
application.register('autosubmit', AutosubmitController);

// Export for use in other files
window.Stimulus = application;

// Standard DOMContentLoaded event handlers (no Turbo)
document.addEventListener('DOMContentLoaded', () => {
    // Hide any loading indicators
    const loader = document.getElementById('turbo-loader');
    if (loader) {
        loader.classList.add('hidden');
    }
});
