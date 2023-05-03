/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const app = createApp({
  data(){
    return{
      new_contact:{
        fname:'',
        lname:'',
        phone:''
      },
      contact:{
        id:'',
        fname:'',
        lname:'',
        phone:''
      },
      contacts:[],
      message:'',
      query:''
    }
  },
  mounted(){
    this.get_contacts();
  },
  methods:{
    get_contacts(){
      axios.get('/phonebook/index')
          .then((response)=>{
            this.contacts = response.data.contacts;
          }).catch((error)=>{
            console.log(error.message);
          });
    },
    create_contact(){
      axios.post('/phonebook/store',this.new_contact)
          .then((response)=>{
            this.contacts = response.data.contacts;
            this.$swal('Success!',response.data.message,'success');

          }).catch((error)=>{
            console.log(error.message);
          });
    },
    update_contact(){
      axios.patch('/phonebook/update/'+this.contact.id,this.contact)
          .then((response)=>{
            console.log(response.data);
            this.contacts = response.data.contacts;
            this.$swal('Success!',response.data.message,'success');
          }).catch((error)=>{
            console.log(error.message);
          });
    },
    remove_contact(){
      axios.delete('/phonebook/delete/'+this.contact.id)
          .then((response)=>{
            this.contacts = response.data.contacts;
            this.$swal('Success!',response.data.message,'success');
          }).catch((error)=>{
            console.log(error.message);
          });
    },
    search_contact(){
      axios.get('/phonebook/index?query='+this.query)
          .then((response)=>{
            this.contacts = response.data.contacts;
            if (response.data.message) {
              this.$swal('Info!',response.data.message,'info');
            }
          }).catch((error)=>{
            console.log(error.message);
          });
    },
    reset_input_fields(){
      this.new_contact.fname = '';
      this.new_contact.lname = '';
      this.new_contact.phone = ''; 
    }
  }
});

app.use(VueSweetalert2);


import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
