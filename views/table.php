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
