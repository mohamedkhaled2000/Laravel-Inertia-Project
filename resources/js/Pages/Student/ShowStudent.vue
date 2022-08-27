<template lang="">
    <Head title="اضافة طالب جديد" />


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
                        <a href="javascript:void(0)">اضافة طالب جديد</a>
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
                        <div class="card-header" style="position: relative">


                            <Link :href="route('student.create')" class="btn btn-success">اضافة طالب جديد</Link>
                            <input type="search"  v-model="search2" @keyup="search()" class="form-control" placeholder="بحث" style="position: absolute;left:40px;width: auto;"/>
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
                                                <tr v-for="(student, i) in students.data">
                                                    <td>{{ ++i }}</td>
                                                    <td>{{ student.email }}</td>
                                                    <td>{{ student.name }}</td>
                                                    <td>{{ student.gender == 1 ? 'ذكر' : 'انثى' }}</td>
                                                    <td>{{ student.grade.name }}</td>
                                                    <td>{{ student.class_room.class_name }}</td>
                                                    <td>{{ student.section.section_name }}</td>
                                                    <td class="text-right py-0 align-middle">
                                                        <div class="btn-group btn-group-sm">
                                                            <Link :href="route('invoices.show',student.id)" class="btn btn-success" title="اضافة رسوم للطالب"><i class="fa fa-plus"></i></Link>
                                                            <Link :href="route('receipt.show',student.id)" class="btn btn-primary" title="سند قبض"><i class="fa fa-credit-card-alt"></i></Link>
                                                            <Link :href="route('processing_fees.show',student.id)" class="btn btn-secondary" title="استبعاد رسوم"><i class="fa fa-retweet"></i></Link>
                                                            <Link :href="route('payment_fees.show',student.id)" class="btn btn-dark" title="سند صرف"><i class="fa fa-money"></i></Link>
                                                            <Link :href="route('student.show',student.id)" class="btn btn-warning" title="عرض بيانات الطالب"><i class="fa fa-eye"></i></Link>
                                                            <Link :href="route('student.edit',student.id)" class="btn btn-info" title="تعديل"><i class="fa fa-edit"></i></Link>
                                                            <button
                                                                type="button"
                                                                @click="destory(student.id)"
                                                                class="btn btn-danger" title="حذف">
                                                                <i class="fa fa-trash"></i>
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
import throttle from "lodash/throttle";

export default {
    props:{
        students: Object
    },
    components:{
        Pagination
    },
    data(){
        return {
            search2 : ''
        }
    },
    methods:{

        search: throttle(function () {
            this.$inertia.replace(this.route('student.index',{search: this.search2}))

        },1000)


    },

    setup(){
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

                    Inertia.delete(route('student.destroy',id),{
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

        return {destory}
    }
}
</script>

