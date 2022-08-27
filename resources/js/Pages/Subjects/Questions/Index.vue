<template lang="">

    <Head title="قائمة الاسئلة" />

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
                            قائمة الاسئلة
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
                        <Link :href="route('question.create')" class="btn btn-success">
                            اضافة سؤال
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
                                <th>اسم السؤال</th>
                                <th>الاجابات</th>
                                <th>الاجابة الصحيحة</th>
                                <th>اسم الاختبار</th>
                                <th>الدرجة</th>
                                <th>العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(question, i) in questions">
                                <td>{{++i}}</td>
                                <td>{{ question.title }}</td>
                                <td>
                                    <p v-for="(ans,x) in JSON.parse(question.answers)"> {{++x +'-'+ ans+"\n"}} </p>
                                </td>
                                <td>{{ question.right_answer }}</td>
                                <td>{{ question.exam.name }}</td>
                                <td>{{ question.score }}</td>
                                <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                                <Link :href="route('question.edit',question.id)" class="btn btn-info">
                                                    <i class="fa fa-edit"></i>
                                                </Link>
                                            <button type="submit" @click="destory(question.id)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
        questions: Object,
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
            Inertia.delete(route("question.destroy", id), {
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
