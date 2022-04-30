<template lang="">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <Link href="/profile">
                <img
                    :src="$page.props.auth.user.image"
                    class="img-circle elevation-2"
                    alt="User Image"
                />
            </Link>

        </div>
        <div class="info">
            <Link href="/profile" class="d-block">{{ $page.props.auth.user.username }}</Link>

        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
        >
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
                <Link href="/" class="nav-link" :class="{'active':$page.component == 'Home'}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    الرئيسية
                </Link>
            </li>

            <li class="nav-item has-treeview">
                <a href="#" class="nav-link" :class="{'active':$page.url.startsWith('/grade')}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        المراحل الدراسية
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <Link :href="route('grade.index')" class="nav-link" :class="{'active':$page.component == 'Grade/Grade'}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>جميع المراحل الدراسية</p>
                        </Link>
                    </li>

                </ul>
            </li>


            <li class="nav-item has-treeview">
                <a href="#" class="nav-link" :class="{'active':$page.url.startsWith('/classes')}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        الصفوف
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <Link :href="route('class.index')" class="nav-link" :class="{'active':$page.component == 'ClassRooms/ClassView'}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>الصفوف الدراسية</p>
                        </Link>
                    </li>

                </ul>
            </li>


            <li class="nav-item has-treeview">
                <a href="#" class="nav-link" :class="{'active':$page.url.startsWith('/section')}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        الاقسام
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <Link :href="route('section.index')" class="nav-link" :class="{'active':$page.component == 'Section/SectionView'}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>الاقسام الدراسية</p>
                        </Link>
                    </li>

                </ul>
            </li>



            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="fa fa-arrow-alt-circle-left"></i>
                    <Link :href="route('logout')" method="post">
                        تسجل الخروج
                    </Link>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</template>
<script>
export default {

};
</script>
<style lang=""></style>
