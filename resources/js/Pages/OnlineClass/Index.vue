<template lang="">

    <Head title="الحصص الاونلاين" />

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link href="/">الرئيسية</Link>
                        </li>
                        <li class="breadcrumb-item active">
                            الحصص الاونلاين
                        </li>
                    </ol>
                    </div>
                </div>


                <div class="row">
                <div class="col-12">

                    <div v-if="$page.props.flash.message" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> تم بنجاح!</h5>
                    {{ $page.props.flash.message }}
                    </div>


                    <div v-if="$page.props.flash.error" class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> خطا!</h5>
                        {{ $page.props.flash.error }}
                    </div>

                    <div class="card-header">
                        <Link :href="route('classes.create')" class="btn btn-success">
                            حصة جديدة مباشر
                        </Link>
                        <Link :href="route('classes.show',1)" class="btn btn-primary">
                            حصة جديدة يدوى
                        </Link>
                    </div>


                    <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table">
                            <thead>
                                <tr>
                                <th style="width: 10px">#</th>
                                <th>عنوان الحصة</th>
                                <th>المرحلة الدراسية</th>
                                <th>الصف الدراسى</th>
                                <th>القسم</th>
                                <th>اسم المعلم</th>
                                <th>تاريخ البداية</th>
                                <th>وقت الحصة</th>
                                <th>رابط الحصة</th>
                                <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(cl, i) in classes">
                                <td>{{++i}}</td>
                                <td>{{ cl.topic }}</td>
                                <td>{{ cl.grade.name }}</td>
                                <td>{{ cl.class_room.class_name }}</td>
                                <td>{{ cl.section.section_name }}</td>
                                <td>{{ cl.user.name }}</td>
                                <td>{{ cl.start_time }}</td>
                                <td>{{ cl.duration }}</td>
                                <td>
                                    <a :href="cl.join_url" class="text-danger">انضم الان</a>
                                </td>
                                <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <button type="submit" @click="destory(cl.meeting_id)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->



                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
            <!-- /.content -->

</template>
<script>
import { Inertia } from '@inertiajs/inertia';
import swal from 'sweetalert';

export default {
    props:{
        classes: Object,
    },

    setup() {
        const destory = (id) => {
        swal({
            title: "هل انت متاكد من الحذف؟",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
            Inertia.delete(route("classes.destroy", id), {
                onSuccess: () => {
                swal("تم الحذف بنجاح", {
                    icon: "success",
                });
                },
            });
            } else {
            swal("هناك شى خطا");
            }
        });
        };

        return { destory };
    },
}
</script>
