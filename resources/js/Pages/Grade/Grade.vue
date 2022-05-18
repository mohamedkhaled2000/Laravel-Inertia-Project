<template lang="">

    <Head title="المراحل الدراسية" />

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
                            المراحل الدراسية
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
                        <Link :href="route('garde.add')" class="btn btn-success">اضافة مرحلة</Link>
                    </div>


                    <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table">
                        <thead>
                            <tr>
                            <th style="width: 10px">#</th>
                            <th>اسم المرحلة</th>
                            <th>الملاحظات</th>
                            <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(grade, i) in grades">
                            <td>{{++i}}</td>
                            <td>{{ grade.name }}</td>
                            <td>{{ grade.notes }}</td>
                            <td class="text-right py-0 align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <Link :href="route('grade.edit',grade.id)" class="btn btn-info"><i class="fa fa-edit"></i></Link>
                                        <button type="submit" @click="destory(grade.id)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                        </table>
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
        grades: Object,
        flash: String
    },

    setup(props){
        const destory = (id) => {

            swal({
            title: "هل انت متاكد من الحذف؟",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            confirmButtonText: 'تاكيد!',
            cancelButtonText: "الغاء"
            })
            .then((willDelete) => {
            if (willDelete) {

                Inertia.delete(route('garde.delete',id),{
                    onSuccess: () => {
                        swal("تم الحذف بنجاح", {
                            icon: "success",
                        });
                    },
                })

            } else {
                swal("هناك شى خطا");
            }
            });
        }

        return {destory}
    }
}
</script>
<style lang="">

</style>
