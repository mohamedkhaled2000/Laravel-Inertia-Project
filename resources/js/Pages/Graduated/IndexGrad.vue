<template lang="">
    <Head title="قائمة المتخرجين" />


    <div  class="content-body">

        <div class="container-fluid">
                <div  class="row page-titles mx-0">
                    <div  class="col-sm-6 p-md-0">
                    <div class="welcome-text">

                    </div>
                    </div>
                    <div
                    class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex"
                    >
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                        <Link href="/">الرئيسية</Link>
                        </li>
                        <li class="breadcrumb-item active">
                        <a href="javascript:void(0)">المتخرجين</a>
                        </li>
                    </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                            <div
                                v-if="$page.props.flash.message"
                                class="alert alert-success alert-dismissible">
                                <button
                                    type="button"
                                    class="close"
                                    data-dismiss="alert"
                                    aria-hidden="true">
                                    ×
                                </button>
                                <h5><i class="icon fa fa-check"></i> تم بنجاح!</h5>
                                {{ $page.props.flash.message }}
                            </div>

                            <div
                                v-if="$page.props.flash.error"
                                class="alert alert-danger alert-dismissible">
                                <button
                                    type="button"
                                    class="close"
                                    data-dismiss="alert"
                                    aria-hidden="true">
                                    ×
                                </button>
                                <h5><i class="icon fa fa-ban"></i> خطا!</h5>
                                {{ $page.props.flash.error }}
                            </div>
                    <div class="card">
                        <div class="card-header">
                            <Link :href="route('graduated.create')" class="btn btn-success">اضافة متخرج جديد</Link>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>البريد الالكترونى</th>
                                                    <th>اسم الطالب</th>
                                                    <th>النوع</th>
                                                    <th>المرحلة الدراسية</th>
                                                    <th>الصف الدراسى</th>
                                                    <th>القسم</th>
                                                    <th>العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(student, i) in students">
                                                    <td>{{ ++i }}</td>
                                                    <td>{{ student.email }}</td>
                                                    <td>{{ student.name }}</td>
                                                    <td>{{ student.gender == 1 ? 'ذكر' : 'انثى' }}</td>
                                                    <td>{{ student.grade.name }}</td>
                                                    <td>{{ student.class_room.class_name }}</td>
                                                    <td>{{ student.section.section_name }}</td>
                                                    <td class="text-right py-0 align-middle">
                                                        <div class="btn-group btn-group-sm">

                                                            <button
                                                                type="button"
                                                                @click="restore(student.id)"
                                                                class="btn btn-warning">
                                                                <i class="fa fa-arrow-up" title="استرجاع الطلاب"></i>
                                                            </button>
                                                            <button
                                                                type="button"
                                                                @click="destroy(student.id)"
                                                                class="btn btn-danger">
                                                                <i class="fa fa-trash" title="استرجاع الطلاب"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                </table>
                            </div>
                        <Pagination :links="students.links"/>

                        </div>
                    </div>
                    </div>
                </div>
            </div>

</div>


</template>
<script>
import Pagination from '../../Shared/Pagination.vue'
import { Inertia } from '@inertiajs/inertia';
import swal from 'sweetalert';

export default {
    props:{
        students: Object
    },
    components:{
        Pagination
    },

    setup(){
        let restore = (id) => {

            swal({
                title: "هل انت متاكد من الاسترجاع؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                confirmButtonText: 'تاكيد!',
                cancelButtonText: "الغاء"
            })
            .then((willDelete) => {
                if (willDelete) {

                    Inertia.get(route('graduated.edit',id),{
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
        }

        let destroy = (id) => {

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

                    Inertia.delete(route('graduated.destroy',id),{
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
        }

        return {restore,destroy}
    }
}
</script>

