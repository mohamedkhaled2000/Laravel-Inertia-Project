<template>
    <Nav />
    <Sidbar/>
    <slot/>
</template>

<script>
import Nav from './Nav'
import Sidbar from './Sidbar'

export default {
    name: "Layout",
    components: {Nav, Sidbar},

}
</script>

