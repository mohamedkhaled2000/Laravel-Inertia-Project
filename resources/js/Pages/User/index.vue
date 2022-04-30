<template>
    <Head>
        <title>User</title>
        <meta type="description" content="User Informations" >

    </Head>

<!--    <Layout>-->
        <h1>User</h1>

<!--    </Layout>-->
<div class="d-flex justify-content-between">
    <input v-model="search" type="text"  placeholder="search">
    <Link class="btn btn-primary" href="/user/create">Create</Link>
</div>

    <table class="table">
        <thead class="thead-light">
        <tr >
            <th scope="col">Name</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in users.data" :key="user.id">
            <td>{{user.name}}</td>
            <td><Link :href="`/user/${user.id}/edit`" class="btn btn-primary">Edit</Link></td>
        </tr>

        </tbody>
    </table>

    <div class="mt-4">
        <Pagination :links="users.links"/>
    </div>

</template>

<script setup>
import Pagination from "../../Shared/Pagination.vue"
import { ref,watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce"
// export default {
//     name: "User",
//     components: {Head,Pagination},
//     props:{
//         users: Object
//     },
    let props = defineProps({
        users: Object,
        filter: Object
        })
// }
    let search = ref(props.filter.search);
    watch(search,debounce(function(value){
        Inertia.get('/user',{search:value},{
            preserveState:true,
            replace:true
        })
    },300));
</script>

<style scoped>

</style>
