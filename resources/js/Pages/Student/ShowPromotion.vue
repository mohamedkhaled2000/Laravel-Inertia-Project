<template lang="">
   <Head title="جميع الترقيات" />


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
                        <a href="javascript:void(0)">جميع الترقيات</a>
                        </li>
                    </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">

                    <div class="card">
                        <div class="card-header">
                            <a @click="destoryALL(1)" class="btn btn-danger">استرجاع الكل</a>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>اسم الطالب</th>
                                            <th class="alert-danger">المرحلة الدراسية السابقة</th>
                                            <th class="alert-danger">السنة الدراسية</th>
                                            <th class="alert-danger">الصف الدراسى السابقة</th>
                                            <th class="alert-danger">القسم السابق</th>
                                            <th class="alert-success">المرحلة الدراسية الحالى</th>
                                            <th class="alert-success">السنة الدراسية</th>
                                            <th class="alert-success">الصف الدراسى الحالى</th>
                                            <th class="alert-success">القسم الحالى</th>
                                            <th>العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(promotion, i) in promotions.data">
                                            <td>{{ ++i }}</td>
                                            <td>{{ promotion.student.name }}</td>
                                            <td>{{ promotion.f_grade.name }}</td>
                                            <td>{{ promotion.academic_year }}</td>
                                            <td>{{ promotion.f_class_room.class_name }}</td>
                                            <td>{{ promotion.f_section.section_name }}</td>
                                            <td>{{ promotion.t_grade.name }}</td>
                                            <td>{{ promotion.academic_year_new }}</td>
                                            <td>{{ promotion.t_class_room.class_name }}</td>
                                            <td>{{ promotion.t_section.section_name }}</td>
                                            <td class="text-right py-0 align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <button
                                                        type="button"
                                                        @click="graduate(promotion.id)"
                                                        class="btn btn-success" title="تخرج">
                                                        <i class="fa fa-arrow-down"></i>
                                                    </button>

                                                    <button
                                                        type="button"
                                                        @click="back(promotion.id)"
                                                        class="btn btn-danger" title="استرجاع">
                                                        <i class="fa fa-arrow-up"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                        <Pagination :links="promotions.links"/>

                        </div>
                    </div>
                    </div>
                </div>
            </div>

</div>




</template>
<script>
import { useForm } from '@inertiajs/inertia-vue3';
import Pagination from '../../Shared/Pagination.vue'
import { Inertia } from '@inertiajs/inertia';
import swal from 'sweetalert';

export default {
    props:{
        promotions : Object,

    },
    components:{
        Pagination
    },

    setup(){
        let destoryALL = (id) => {

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

                    Inertia.delete(route('promotion.destroy',id),{
                        onSuccess: () => {
                            swal("تم الاسترجاع بنجاح", {
                                icon: "success",
                            });
                        },
                    });

                } else {
                    swal("هناك شى خطا");
                }
            });
        }

        let back = (id) => {

            swal({
                title: "هل انت متاكد من استرجاع الطالب؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                confirmButtonText: 'تاكيد!',
                cancelButtonText: "الغاء"
            })
            .then((willDelete) => {
                if (willDelete) {

                    Inertia.get(route('stdReturn',id),{
                        onSuccess: () => {
                            swal("تم الاسترجاع بنجاح", {
                                icon: "success",
                            });
                        },
                    });

                } else {
                    swal("هناك شى خطا");
                }
            });
        }

        let graduate = (id) => {

            swal({
                title: "هل انت متاكد من تخرج الطالب؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                confirmButtonText: 'تاكيد!',
                cancelButtonText: "الغاء"
            })
            .then((willDelete) => {
                if (willDelete) {

                    Inertia.get(route('promotion.edit',id),{
                        onSuccess: () => {
                            swal("تم الاسترجاع بنجاح", {
                                icon: "success",
                            });
                        },
                    });

                } else {
                    swal("هناك شى خطا");
                }
            });
        }

        return {destoryALL,back,graduate}
    }

}
</script>
