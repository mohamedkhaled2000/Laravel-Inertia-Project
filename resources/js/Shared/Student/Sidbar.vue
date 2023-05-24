<template>
    <div class="dlabnav h-100">
        <div class="dlabnav-scroll">
            <ul class="metismenu" id="menu">
                <li class="nav-label first">
                    القائمة الجانبية
                </li>
                <li>
                    <Link aria-expanded="false" :href="route('STDHome')" :class="{'active':$page.component == 'STDHome'}">
                        <i class="la la-home">
                        </i>
                        <span class="nav-text">
                            الرئيسية
                        </span>
                    </Link>
                </li>

                <li >
                    <a aria-expanded="false" class="has-arrow" href="javascript:void()" :class="{'active':$page.url.startsWith('/grade')}">
                        <i class="la la-building">
                        </i>
                        <span class="nav-text">
                            المراحل الدراسية
                        </span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                            <Link href="l" class="nav-link" :class="{'active':$page.component == 'Grade/Grade'}">
                                جميع المراحل الدراسية
                            </Link>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</template>
