import './bootstrap';
import { Application } from '@hotwired/stimulus';
import '@hotwired/turbo';

// Initialize Stimulus
const application = Application.start();

// Manually register controllers (simpler approach)
import DropdownController from './controllers/dropdown_controller';
import ModalController from './controllers/modal_controller';
import TabsController from './controllers/tabs_controller';
import ToggleController from './controllers/toggle_controller';
import MobileNavController from './controllers/mobile_nav_controller';
import LoaderController from './controllers/loader_controller';
import AutosubmitController from './controllers/autosubmit_controller';

application.register('dropdown', DropdownController);
application.register('modal', ModalController);
application.register('tabs', TabsController);
application.register('toggle', ToggleController);
application.register('mobile-nav', MobileNavController);
application.register('loader', LoaderController);
application.register('autosubmit', AutosubmitController);

// Export for use in other files
window.Stimulus = application;

// Turbo is automatically initialized when imported
// Configuration can be done via data attributes or Turbo global
if (window.Turbo) {
    window.Turbo.session.drive = true;
}

// Handle Turbo events for better UX
document.addEventListener('turbo:before-visit', (event) => {
    // Show loading indicator if needed
    const loader = document.getElementById('turbo-loader');
    if (loader) {
        loader.classList.remove('hidden');
    }
});

document.addEventListener('turbo:visit', (event) => {
    // Hide any previous error messages
    const errorMessages = document.querySelectorAll('.turbo-error-message');
    errorMessages.forEach(msg => msg.remove());
});

document.addEventListener('turbo:load', (event) => {
    // Hide loading indicator
    const loader = document.getElementById('turbo-loader');
    if (loader) {
        loader.classList.add('hidden');
    }
    
    // Reinitialize any components that need it
    if (typeof tinymce !== 'undefined') {
        tinymce.init({
            selector: '.rich-text-editor',
            height: 400,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic forecolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
            setup: function(editor) {
                editor.on('init', function() {
                    // Handle Turbo frame navigation
                    if (editor.getContainer().closest('turbo-frame')) {
                        editor.on('remove', function() {
                            tinymce.remove(editor.id);
                        });
                    }
                });
            }
        });
    }
});// Handle form submissions with Turbo
document.addEventListener('turbo:submit-end', (event) => {
    if (event.detail.success) {
        // Handle successful form submission
        const form = event.target;
        if (form.dataset.turboReset === 'true') {
            form.reset();
        }
    }
});

// Handle Turbo frame events
document.addEventListener('turbo:frame-load', (event) => {
    // Reinitialize components inside frames
    const frame = event.target;
    if (frame.querySelector('.rich-text-editor')) {
        // TinyMCE will auto-initialize
    }
});
