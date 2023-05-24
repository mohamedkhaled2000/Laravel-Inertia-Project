<template>
    <div class="dlabnav">
        <div class="dlabnav-scroll">
            <ul class="metismenu" id="menu">
                <li class="nav-label first">
                    القائمة الجانبية
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
                            <Link :href="route('class.index')" :class="{'active':$page.component == 'ClassRooms/ClassView'}">
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
                        <i class="la la-dollar">
                        </i>
                        <span class="nav-text">
                            الحسابات
                        </span>
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

                        <li>
                            <Link :href="route('receipt.index')">
                                سندات القبض
                            </Link>
                        </li>

                        <li>
                            <Link :href="route('processing_fees.index')">
                                الرسوم المستبعدة
                            </Link>
                        </li>

                        <li>
                            <Link :href="route('payment_fees.index')">
                                سندات الصرف
                            </Link>
                        </li>


                    </ul>
                </li>
                <li>
                    <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                        <i class="la la-users">
                        </i>
                        <span class="nav-text">
                            الحضور والغياب
                        </span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                            <Link :href="route('attentance.index')">
                                قائمة الطلاب
                            </Link>
                        </li>

                    </ul>
                </li>

                <li>
                    <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                        <i class="la la-book">
                        </i>
                        <span class="nav-text">
                            المواد الدراسية
                        </span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                            <Link :href="route('subject.index')">
                                قائمة المواد
                            </Link>
                        </li>

                    </ul>
                </li>
                <li>
                    <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                        <i class="la la-question-circle">
                        </i>
                        <span class="nav-text">
                            الامتحانات
                        </span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                            <Link :href="route('exam.index')">
                                قائمة الامتحانات
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('question.index')">
                                قائمة الاسئلة
                            </Link>
                        </li>

                    </ul>
                </li>

                <li>
                    <a aria-expanded="false" class="has-arrow" href="javascript:void()">
                        <i class="la la-video-camera">
                        </i>
                        <span class="nav-text">
                            الحصص الاونلاين
                        </span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                            <Link :href="route('classes.index')">
                                قائمة الحصص
                            </Link>
                        </li>
                    </ul>
                </li>
                <li>
                    <a aria-expanded="false" class="has-arrow ai-icon" href="javascript:void()">
                        <i class="la la-book">
                        </i>
                        <span class="nav-text">
                            المكتبة
                        </span>
                    </a>
                    <ul aria-expanded="false">
                        <li>
                            <Link :href="route('library.index')">
                                    قائمة الكتب
                            </Link>
                        </li>
                    </ul>
                </li>
                <li class="mega-menu mega-menu-xl">
                    <Link :href="route('setting.index')">
                        <i class="la la-cogs">
                        </i>
                            الاعدادات
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template>
