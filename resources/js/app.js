require('./bootstrap');
require('./font-awesome');
require('./vee-validate');

window.Vue = require('vue');

// Custom components
import PFileInput from "./components/inputs/PFileInput";
import PInput from "./components/inputs/PInput";
import PTextArea from "./components/inputs/PTextArea";
import PSelect from "./components/inputs/PSelect";
import PAlert from "./components/PAlert";
import PDeleteButton from "./components/buttons/PDeleteButton";
import PDeleteModal from "./components/PDeleteModal";

Vue.component("p-file-input", PFileInput);
Vue.component("p-alert", PAlert);
Vue.component("p-input", PInput);
Vue.component("p-textarea", PTextArea);
Vue.component('p-select', PSelect);
Vue.component('p-delete-button', PDeleteButton);
Vue.component('p-delete-modal', PDeleteModal);

// Custom forms
import PForm from "./components/forms/PForm";

Vue.component('p-form', PForm);

// Bootstrap-vue
import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
