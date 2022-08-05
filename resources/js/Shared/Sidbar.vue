<template lang="">


            <!--**********************************
            Sidebar start
        ***********************************-->
            <div class="dlabnav">
                <div class="dlabnav-scroll">
                    <ul class="metismenu" id="menu">
                        <li class="nav-label first">
                            Main Menu
                        </li>
                        <li>
                            <Link aria-expanded="false" href="/" :class="{'active':$page.component == 'Home'}">
                                <i class="la la-home">
                                </i>
                                <span class="nav-text">
                                    الرئيسية
                                </span>
                            </Link>
                        </li>


                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()" :class="{'active':$page.url.startsWith('/grade')}">
                                <i class="la la-building">
                                </i>
                                <span class="nav-text">
                                    المراحل الدراسية
                                </span>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <Link :href="route('grade.index')" class="nav-link" :class="{'active':$page.component == 'Grade/Grade'}">
                                        جميع المراحل الدراسية
                                    </Link>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()" :class="{'active':$page.url.startsWith('/classes')}">
                                <i class="la la-user">
                                </i>
                                <span class="nav-text">
                                    الصفوف
                                </span>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <Link :href="route('class.index')" class="nav-link" :class="{'active':$page.component == 'ClassRooms/ClassView'}">
                                        <p>الصفوف الدراسية</p>
                                    </Link>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()" :class="{'active':$page.url.startsWith('/section')}">
                                <i class="la la-user">
                                </i>
                                <span class="nav-text">
                                    الاقسام
                                </span>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <Link :href="route('section.index')" class="nav-link" :class="{'active':$page.component == 'Section/SectionView'}">
                                        <p>الاقسام الدراسية</p>
                                    </Link>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()" :class="{'active':$page.url.startsWith('/students')}">
                                <i class="la la-users">
                                </i>
                                <span class="nav-text">
                                    اولياء الامور
                                </span>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <Link :href="route('parent.show')" class="nav-link" :class="{'active':$page.component == 'Student/AddParent'}">
                                        اولياء الامور
                                    </Link>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()" :class="{'active':$page.url.startsWith('/teacher')}">
                                <i class="la la-user">
                                </i>
                                <span class="nav-text">
                                    المعلمين
                                </span>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <Link :href="route('teacher.index')" class="nav-link" :class="{'active':$page.component == 'Teacher/TeacherView'}">
                                        كل المعلمين
                                    </Link>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                                <i class="la la-users">
                                </i>
                                <span class="nav-text">
                                    الطلاب
                                </span>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <Link :href="route('student.index')">
                                        قائمة الطلاب
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('promotion.index')">
                                        ترقية الطلاب
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('promotion.create')">
                                        جميع الترقيات
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('graduated.index')">
                                        الطلاب المتخرجين
                                    </Link>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                                <span class="nav-text">
                                    الحسابات
                                </span>
                                <i class="la la-building">
                                </i>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <Link :href="route('fees.index')">
                                        الرسوم الدراسية
                                    </Link>
                                </li>

                                <li>
                                    <Link :href="route('invoices.index')">
                                        الفواتير الدراسية
                                    </Link>
                                </li>


                            </ul>
                        </li>
                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                                <span class="nav-text">
                                    Staff
                                </span>
                                <i class="la la-users">
                                </i>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <a href="all-staff.html">
                                        All Staff
                                    </a>
                                </li>
                                <li>
                                    <a href="add-staff.html">
                                        Add Staff
                                    </a>
                                </li>
                                <li>
                                    <a href="edit-staff.html">
                                        Edit Staff
                                    </a>
                                </li>
                                <li>
                                    <a href="staff-profile.html">
                                        Staff Profile
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                                <span class="nav-text">
                                    Holiday
                                </span>
                                <i class="la la-gift">
                                </i>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <a href="all-holiday.html">
                                        All Holiday
                                    </a>
                                </li>
                                <li>
                                    <a href="add-holiday.html">
                                        Add Holiday
                                    </a>
                                </li>
                                <li>
                                    <a href="edit-holiday.html">
                                        Edit Holiday
                                    </a>
                                </li>
                                <li>
                                    <a href="holiday-calendar.html">
                                        Holiday Calendar
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                                <span class="nav-text">
                                    Fees
                                </span>
                                <i class="la la-dollar">
                                </i>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <a href="fees-collection.html">
                                        Fees Collection
                                    </a>
                                </li>
                                <li>
                                    <a href="add-fees.html">
                                        Add Fees
                                    </a>
                                </li>
                                <li>
                                    <a href="fees-receipt.html">
                                        Fees Receipt
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-label">
                            Apps
                        </li>
                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                                <span class="nav-text">
                                    Apps
                                </span>
                                <i class="la la-users">
                                </i>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <a href="./app-profile.html">
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                                        Email
                                    </a>
                                    <ul aria-expanded="false">
                                        <li>
                                            <a href="./email-compose.html">
                                                Compose
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./email-inbox.html">
                                                Inbox
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./email-read.html">
                                                Read
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="./app-calender.html">
                                        Calendar
                                    </a>
                                </li>
                                <li>
                                    <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                                        Shop
                                    </a>
                                    <ul aria-expanded="false">
                                        <li>
                                            <a href="./ecom-product-grid.html">
                                                Product Grid
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./ecom-product-list.html">
                                                Product List
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./ecom-product-detail.html">
                                                Product Details
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./ecom-product-order.html">
                                                Order
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./ecom-checkout.html">
                                                Checkout
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./ecom-invoice.html">
                                                Invoice
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./ecom-customers.html">
                                                Customers
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a aria-expanded="false" class="has-arrow ai-icon" href="javascript:void()">
                                <span class="nav-text">
                                    Charts
                                </span>
                                <i class="la la-signal">
                                </i>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <a href="./chart-flot.html">
                                        Flot
                                    </a>
                                </li>
                                <li>
                                    <a href="./chart-morris.html">
                                        Morris
                                    </a>
                                </li>
                                <li>
                                    <a href="./chart-chartjs.html">
                                        Chartjs
                                    </a>
                                </li>
                                <li>
                                    <a href="./chart-chartist.html">
                                        Chartist
                                    </a>
                                </li>
                                <li>
                                    <a href="./chart-sparkline.html">
                                        Sparkline
                                    </a>
                                </li>
                                <li>
                                    <a href="./chart-peity.html">
                                        Peity
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-label">
                            Components
                        </li>
                        <li class="mega-menu mega-menu-xl">
                            <a aria-expanded="false" class="has-arrow ai-icon" href="javascript:void()">
                                <span class="nav-text">
                                    Bootstrap
                                </span>
                                <i class="la la-globe">
                                </i>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <a href="./ui-accordion.html">
                                        Accordion
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-alert.html">
                                        Alert
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-badge.html">
                                        Badge
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-button.html">
                                        Button
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-modal.html">
                                        Modal
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-button-group.html">
                                        Button Group
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-list-group.html">
                                        List Group
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-media-object.html">
                                        Media Object
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-card.html">
                                        Cards
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-carousel.html">
                                        Carousel
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-dropdown.html">
                                        Dropdown
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-popover.html">
                                        Popover
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-progressbar.html">
                                        Progressbar
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-tab.html">
                                        Tab
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-typography.html">
                                        Typography
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-pagination.html">
                                        Pagination
                                    </a>
                                </li>
                                <li>
                                    <a href="./ui-grid.html">
                                        Grid
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                                <span class="nav-text">
                                    Plugins
                                </span>
                                <i class="la la-plus-square-o">
                                </i>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <a href="./uc-select2.html">
                                        Select 2
                                    </a>
                                </li>
                                <li>
                                    <a href="./uc-nestable.html">
                                        Nestedable
                                    </a>
                                </li>
                                <li>
                                    <a href="./uc-noui-slider.html">
                                        Noui Slider
                                    </a>
                                </li>
                                <li>
                                    <a href="./uc-sweetalert.html">
                                        Sweet Alert
                                    </a>
                                </li>
                                <li>
                                    <a href="./uc-toastr.html">
                                        Toastr
                                    </a>
                                </li>
                                <li>
                                    <a href="./map-jqvmap.html">
                                        Jqv Map
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a aria-expanded="false" href="widget-basic.html">
                                <span class="nav-text">
                                    Widget
                                </span>
                                <i class="la la-desktop">
                                </i>
                            </a>
                        </li>
                        <li class="nav-label">
                            Forms
                        </li>
                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                                <span class="nav-text">
                                    Forms
                                </span>
                                <i class="la la-file-text">
                                </i>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <a href="./form-element.html">
                                        Form Elements
                                    </a>
                                </li>
                                <li>
                                    <a href="./form-wizard.html">
                                        Wizard
                                    </a>
                                </li>
                                <li>
                                    <a href="./form-editor-summernote.html">
                                        Summernote
                                    </a>
                                </li>
                                <li>
                                    <a href="form-pickers.html">
                                        Pickers
                                    </a>
                                </li>
                                <li>
                                    <a href="form-validation-jquery.html">
                                        Jquery Validate
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-label">
                            Table
                        </li>
                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                                <span class="nav-text">
                                    Table
                                </span>
                                <i class="la la-table">
                                </i>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <a href="table-bootstrap-basic.html">
                                        Bootstrap
                                    </a>
                                </li>
                                <li>
                                    <a href="table-datatable-basic.html">
                                        Datatable
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-label">
                            Extra
                        </li>
                        <li>
                            <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                                <span class="nav-text">
                                    Pages
                                </span>
                                <i class="la la-th-list">
                                </i>
                            </a>
                            <ul aria-expanded="false">
                                <li>
                                    <a href="./page-register.html">
                                        Register
                                    </a>
                                </li>
                                <li>
                                    <a href="./page-login.html">
                                        Login
                                    </a>
                                </li>
                                <li>
                                    <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                                        Error
                                    </a>
                                    <ul aria-expanded="false">
                                        <li>
                                            <a href="./page-error-400.html">
                                                Error 400
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./page-error-403.html">
                                                Error 403
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./page-error-404.html">
                                                Error 404
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./page-error-500.html">
                                                Error 500
                                            </a>
                                        </li>
                                        <li>
                                            <a href="./page-error-503.html">
                                                Error 503
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="./page-lock-screen.html">
                                        Lock Screen
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!--**********************************
            Sidebar end
        ***********************************-->





</template>
<script>
export default {

};
</script>
<style lang=""></style>
