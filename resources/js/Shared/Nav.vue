<template>
    <!-- <ul class="navbar-nav mr-auto"> -->
        <!-- <li class="nav-item ml-5 float-right"><Link href="/" :class="{'btn btn-primary': $page.component == 'Home'}">Home</Link></li>
        <li class="nav-item ml-5 float-right"><Link href="/setting" :class="{'btn btn-primary': $page.component == 'Setting'}">Setting</Link></li>
        <li class="nav-item ml-5 float-right"><Link href="/user" :class="{'btn btn-primary': $page.component == 'User/index'}">User</Link></li> -->
        <!-- <li class="nav-item ml-5 float-right"><Link href="/logout" method="post">Logout</Link></li> -->
    <!-- </ul> -->





            <div class="nav-header" style="right: 0;">
                <Link class="brand-logo" href="/">
                    <img alt="" class="logo-abbr" src="/backend/images/logo-white-2.png">
                        <img alt="" class="logo-compact" src="/backend/images/logo-text-white.png">
                            <img alt="" class="brand-title" src="/backend/images/logo-text-white.png">
                </Link>
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="line">
                        </span>
                        <span class="line">
                        </span>
                        <span class="line">
                        </span>
                    </div>
                </div>
            </div>
            <!--**********************************
            Nav header end
        ***********************************-->
            <!--**********************************
            Header start
        ***********************************-->
            <div class="header">
                <div class="header-content">
                    <nav class="navbar navbar-expand">
                        <div class="collapse navbar-collapse justify-content-between">
                            <div class="header-left">
                                <div class="search_bar dropdown">
                                    <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                        <i class="mdi mdi-magnify">
                                        </i>
                                    </span>
                                    <div class="dropdown-menu p-0 m-0">
                                        <form>
                                            <input aria-label="Search" class="form-control" placeholder="Search" type="search">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <ul class="navbar-nav header-right">
                                <li class="nav-item dropdown notification_dropdown">
                                    <a class="nav-link bell ai-icon" data-toggle="dropdown" href="#" role="button">
                                        <svg class="feather feather-bell" fill="none" height="20" id="icon-user" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9">
                                            </path>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0">
                                            </path>
                                        </svg>
                                        <div class="pulse-css">
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-left">
                                        <ul class="list-unstyled">
                                            <li class="media dropdown-item">
                                                <span class="success">
                                                    <i class="ti-user">
                                                    </i>
                                                </span>
                                                <div class="media-body">
                                                    <a href="#">
                                                        <p>
                                                            <strong>
                                                                Martin
                                                            </strong>
                                                            has added a
                                                            <strong>
                                                                customer
                                                            </strong>
                                                            Successfully
                                                        </p>
                                                    </a>
                                                </div>
                                                <span class="notify-time">
                                                    3:20 am
                                                </span>
                                            </li>
                                            <li class="media dropdown-item">
                                                <span class="primary">
                                                    <i class="ti-shopping-cart">
                                                    </i>
                                                </span>
                                                <div class="media-body">
                                                    <a href="#">
                                                        <p>
                                                            <strong>
                                                                Jennifer
                                                            </strong>
                                                            purchased Light Dashboard 2.0.
                                                        </p>
                                                    </a>
                                                </div>
                                                <span class="notify-time">
                                                    3:20 am
                                                </span>
                                            </li>
                                            <li class="media dropdown-item">
                                                <span class="danger">
                                                    <i class="ti-bookmark">
                                                    </i>
                                                </span>
                                                <div class="media-body">
                                                    <a href="#">
                                                        <p>
                                                            <strong>
                                                                Robin
                                                            </strong>
                                                            marked a
                                                            <strong>
                                                                ticket
                                                            </strong>
                                                            as unsolved.
                                                        </p>
                                                    </a>
                                                </div>
                                                <span class="notify-time">
                                                    3:20 am
                                                </span>
                                            </li>
                                            <li class="media dropdown-item">
                                                <span class="primary">
                                                    <i class="ti-heart">
                                                    </i>
                                                </span>
                                                <div class="media-body">
                                                    <a href="#">
                                                        <p>
                                                            <strong>
                                                                David
                                                            </strong>
                                                            purchased Light Dashboard 1.0.
                                                        </p>
                                                    </a>
                                                </div>
                                                <span class="notify-time">
                                                    3:20 am
                                                </span>
                                            </li>
                                            <li class="media dropdown-item">
                                                <span class="success">
                                                    <i class="ti-image">
                                                    </i>
                                                </span>
                                                <div class="media-body">
                                                    <a href="#">
                                                        <p>
                                                            <strong>
                                                                James.
                                                            </strong>
                                                            has added a
                                                            <strong>
                                                                customer
                                                            </strong>
                                                            Successfully
                                                        </p>
                                                    </a>
                                                </div>
                                                <span class="notify-time">
                                                    3:20 am
                                                </span>
                                            </li>
                                        </ul>
                                        <a class="all-notification" href="#">
                                            See all notifications
                                            <i class="ti-arrow-right">
                                            </i>
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown header-profile">
                                    <a class="nav-link" data-toggle="dropdown" href="#" role="button">
                                        <img
                                            :src="$page.props.auth.user.image"
                                            class="img-circle elevation-2"
                                            alt="User Image"
                                        />
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-left">
                                        <Link href="/profile" class="dropdown-item ai-icon" >
                                            <svg class="feather feather-user" fill="none" height="18" id="icon-user1" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2">
                                                </path>
                                                <circle cx="12" cy="7" r="4">
                                                </circle>
                                            </svg>
                                            <span class="ml-2">
                                                الملف الشخصى
                                            </span>
                                        </Link>
                                        <a class="dropdown-item ai-icon" href="./email-inbox.html">
                                            <svg class="feather feather-mail" fill="none" height="18" id="icon-inbox" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                </path>
                                                <polyline points="22,6 12,13 2,6">
                                                </polyline>
                                            </svg>
                                            <span class="ml-2">
                                                الرسائل
                                            </span>
                                        </a>
                                        <Link class="dropdown-item ai-icon" :href="route('logout')" method="post">
                                            <svg class="feather feather-log-out" fill="none" height="18" id="icon-logout" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4">
                                                </path>
                                                <polyline points="16 17 21 12 16 7">
                                                </polyline>
                                                <line x1="21" x2="9" y1="12" y2="12">
                                                </line>
                                            </svg>
                                            <span class="ml-2">
                                                تسجل الخروج
                                            </span>
                                        </Link>
                                    </div>
                                </li>


                                <li class="nav-item dropdown header-profile">
                                    <!-- <div id="dark-btn" @click="dark">
                                        <span></span>
                                    </div> -->
                                    <i class="fa-solid fa-moon change-theme" id="theme-button" @click="dark"></i>

                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
</template>

<script>

export default {
    name: "Nav",

    methods: {
        dark(){
            const themeButton = document.getElementById('theme-button')
            const darkTheme = 'dark-theme'
            const iconTheme = 'fa-sun'

            // Previously selected topic (if user selected)
            const selectedTheme = localStorage.getItem('selected-theme')
            const selectedIcon = localStorage.getItem('selected-icon')

            // We obtain the current theme that the interface has by validating the dark-theme class
            const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light'
            const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? 'fa-moon' : 'fa-sun'

            // We validate if the user previously chose a topic
            if (selectedTheme) {
            // If the validation is fulfilled, we ask what the issue was to know if we activated or deactivated the dark
            document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme)
            themeButton.classList[selectedIcon === 'fa-moon' ? 'add' : 'remove'](iconTheme)
            }

            // Activate / deactivate the theme manually with the button
            themeButton.addEventListener('click', () => {
                // Add or remove the dark / icon theme
                document.body.classList.toggle(darkTheme)
                themeButton.classList.toggle(iconTheme)
                // We save the theme and the current icon that the user chose
                localStorage.setItem('selected-theme', getCurrentTheme())
                localStorage.setItem('selected-icon', getCurrentIcon())
            })

        }
    },
}
</script>

<style>
    .dark-theme .button__gray {
        background-color: var(--container-color);
    }

    .dark-theme .button__gray:hover {
        background-color: hsl(var(--hue), 24%, 16%);
    }

    .dark-theme .filters__content {
        background-color: var(--container-color);
    }

    .dark-theme::-webkit-scrollbar {
        background-color: hsl(var(--hue), 8%, 16%);
    }

    .dark-theme::-webkit-scrollbar-thumb {
        background-color: hsl(var(--hue), 8%, 24%);
    }

    .dark-theme::-webkit-scrollbar-thumb:hover {
        background-color: hsl(var(--hue), 8%, 32%);
    }

</style>



<!--//// Advance-->

<!--<template>-->
<!--    <ul>-->
<!--        <li><NavLink href="/" :active="$page.component == 'Home'">Home</NavLink></li>-->
<!--        <li><NavLink href="/setting" :active="$page.component == 'Setting'">Setting</NavLink></li>-->
<!--        <li><NavLink href="/user" :active="$page.component == 'User'">User</NavLink></li>-->
<!--    </ul>-->
<!--</template>-->

<!--<script>-->
<!--import NavLink from './NavLink'-->
<!--export default {-->
<!--    name: "Nav",-->
<!--    components: {NavLink},-->

<!--}-->
<!--</script>-->

<!--<style scoped>-->

<!--</style>-->
