<template lang="">
    <div>
        <form @submit.prevent="submit">
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input
                    v-model="form.name"
                    type="text"
                    class="form-control"
                    name="name"/>

                <div v-if="form.errors.name" v-text="form.errors.name" class="text-danger"></div>

            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input
                    v-model="form.email"
                    name="email"
                    type="email"
                    class="form-control"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                />
                <div v-if="form.errors.email" v-text="form.errors.email" class="text-danger"></div>

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input
                    v-model="form.password"
                    type="password"
                    class="form-control"
                    name="password"
                    id="exampleInputPassword1"
                />
                <div v-if="form.errors.password" v-text="form.errors.password" class="text-danger"></div>

            </div>
            <button type="submit" class="btn btn-primary" :disabled="form.processing">Create</button>
        </form>
    </div>
</template>
<script setup>
import { useForm } from "@inertiajs/inertia-vue3";


let form = useForm({
    'name' : '',
    'email' : '',
    'password' : '',
});

let submit = ()=>{
    form.post('/user/store')
}

</script>
