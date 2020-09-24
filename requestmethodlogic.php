<script>
        var app = new Vue({
            el: '#vueapp',
            data: {
                name: '',
                email: '',
                country: '',
                city: '',
                job: '',
                contacts: [],
            },
            mounted: function () {
                console.log('Hello from Vue!')
                this.getContacts();
            },
            methods: {
                getContacts: function(){
                    console.log('rendering contacts')
        axios.get('api/contacts.php')
        .then(function (response) {
            console.log(response.data);
            app.contacts = response.data;

        })
        .catch(function (error) {
            console.log(error);
        });
    },
    createContact: function(){
        console.log("Create contact!")

        let formData = new FormData();
        console.log("name:", this.name)
        formData.append('name', this.name)
        formData.append('email', this.email)
        formData.append('city', this.city)
        formData.append('country', this.country)
        formData.append('job', this.job)

        var contact = {};
        formData.forEach(function(value, key){
            contact[key] = value;
        });

        axios({
            method: 'post',
            url: 'api/contacts.php',
            data: formData,
            config: { headers: {'Content-Type': 'multipart/form-data' }}
        })
        .then(function (response) {
            //handle success
            console.log(response)
            app.contacts.push(contact)
            app.resetForm();
        })
        .catch(function (response) {
            //handle error
            console.log(response)
        });
    },
    resetForm: function(){
        this.name = '';
        this.email = '';
        this.country = '';
        this.city = '';
        this.job = '';
    }
            }
        })
    </script>
