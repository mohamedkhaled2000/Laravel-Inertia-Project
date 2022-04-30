<template>

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <Nav  />
    </nav>


    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="bottom: 0;
                                                                float: none;
                                                                height: 100vh;
                                                                right: 0;
                                                                position: fixed;
                                                                top: 0;" >
        <div class="sidebar">
            <Sidbar />
        </div>

    </aside>


    <slot />

</template>

<script>
import Nav from './Nav'
import Sidbar from './Sidbar'

export default {
    name: "Layout",
    components: {Nav,Sidbar},

}
</script>

