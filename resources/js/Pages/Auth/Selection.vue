<template>
    <Head>
        <title>حدد طريقة الدخول</title>
        <meta type="description" content="Login Informations" />
    </Head>
    <div class="container" style="max-width: 40rem;overflow: hidden">
        <div class="authincation-content" style="margin-top: 10rem">
            <div class="auth-form" style="height:17rem">
                <h4 class="text-center mb-4">حدد طريقة الدخول</h4>
                <div class="form-inline">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <Link class="btn btn-default col-lg-3" title="طالب" :href="route('loginStudent')">
                                <img src="images/student.png" class="rounded-circle" alt="user-img" width="100" height="100">
                            </Link>
                        </div>

                        <div class="col-md-3 col-12">
                            <Link class="btn btn-default col-lg-3" title="ولي امر" :href="route('loginAdmin')">
                                <img src="images/parent.jpg" class="rounded-circle" alt="user-img" width="100" height="100">
                            </Link>
                        </div>

                        <div class="col-md-3 col-12">
                            <Link class="btn btn-default col-lg-3" title="معلم" :href="route('loginAdmin')">
                                <img src="images/teacher.png" class="rounded-circle" alt="user-img" width="100" height="100">
                            </Link>
                        </div>

                        <div class="col-md-3 col-12">
                            <Link class="btn btn-default col-lg-3" title="ادمن" :href="route('loginAdmin')">
                                <img src="images/admin.png" class="rounded-circle" alt="user-img" width="100" height="100">
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        layout: false,
    };
</script>
