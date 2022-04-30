<template>

    <Head>
        <title>Setting</title>
        <meta type="description" content="Setting Informations">
    </Head>
<!--    <Layout>-->
        <h1>Setting</h1>

<!--    </Layout>-->



    <div style="margin-top: 4000px">
        <p >The Current Time: {{ time }}</p>
        <Link herf="/setting" preserveScroll>Refresh</Link>
    </div>

</template>

<script>
import Nav from "../Shared/Nav";
import {Link} from "@inertiajs/inertia-vue3";
// import Layout from "../Shared/Layout";
import {Head} from "@inertiajs/inertia-vue3"

export default {
    name: "Settting",
    components: {Link,Head},
    props:{
        time: String
    }

}
</script>

<style scoped>

</style>
