<form>
    <br/>
        <label> Name </label>
            <input type="text" name=name v-model="name">
            <br/>
        <label> Email </label>
            <input type="text" name=email v-model="email">
        <br/>
        <label> Country </label>
            <input type="text" name=country v-model="country">
        <br/>
        <label> City </label>
            <input type="text" name=city v-model="city">
        <br/>
        <label> Job </label>
            <input type="text" name=job v-model="job">
        <br/>
            <input type="button" v-on:click=createContact() value="Add">
    </form>
