<!DOCTYPE html>
<html lang-"en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PHP| MySQL | Vue.js | Axios Example</title>
        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    </head>
    <body>
    <h1>Contact Management</h1>
    <div id='vueapp'>

    <form>
    <br/>
        <label> Name </label>
            <input type="text" name=name v-model="name" required>
            <br/>
        <label> Email </label>
            <input type="text" name=email v-model="email" required>
        <br/>
        <label> Country </label>
            <input type="text" name=country v-model="country" required>
        <br/>
        <label> City </label>
            <input type="text" name=city v-model="city" required>
        <br/>
        <label> Job </label>
            <input type="text" name=job v-model="job" required>
        <br/>
            <input type="button" v-on:click=createContact() value="Add">
    </form>
    <table border='1' width='100%' style='border-collapse: collapse;'>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Country</th>
        <th>City</th>
        <th>Job</th>

    </tr>

    <tr v-for='contact in contacts'>
        <td>{{ contact.name }}</td>
        <td>{{ contact.email }}</td>
        <td>{{ contact.country }}</td>
        <td>{{ contact.city }}</td>
        <td>{{ contact.job }}</td>
    </tr>
    </table>
</div>
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

    
    </body>
</html>