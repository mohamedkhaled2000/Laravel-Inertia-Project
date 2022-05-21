<template lang="">

    <Head title="المعلمين" />

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
                        <a href="javascript:void(0)">المعلمين</a>
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
                            <Link :href="route('teacher.create')" class="btn btn-success">اضافة معلم</Link>
                        </div>
                        <div class="card-body">

                                <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">#</th>
                                                    <th>البريد الالكترونى</th>
                                                    <th>اسم المعلم</th>
                                                    <th>التخصص</th>
                                                    <th>الجنس</th>
                                                    <th>تاريخ التوظيف</th>
                                                    <th>العنوان</th>
                                                    <th>العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(teacher, i) in teachers.data">
                                                    <td>{{ ++i }}</td>
                                                    <td>{{ teacher.email }}</td>
                                                    <td>{{ teacher.name }}</td>
                                                    <td>{{ teacher.specialize.name }}</td>
                                                    <td>{{ teacher.gender == 1 ? "ذكر" : "انثى" }}</td>
                                                    <td>{{ teacher.join_date }}</td>
                                                    <td>{{ teacher.address }}</td>
                                                    <td class="text-right py-0 align-middle">
                                                        <div class="btn-group btn-group-sm">
                                                            <Link :href="route('teacher.edit',teacher.id)" class="btn btn-info"><i class="fa fa-edit"></i
                                                            ></Link>
                                                            <button
                                                                type="button"
                                                                @click="destory(teacher.id)"
                                                                class="btn btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                </table>
                        <Pagination :links="teachers.links"/>

                        </div>
                    </div>
                    </div>
                </div>
            </div>

</div>



</template>
<script>
import Pagination from '../../Shared/Pagination.vue'
import { Inertia } from "@inertiajs/inertia";
import swal from "sweetalert";
export default {
    props:{
        teachers : Object
    },
    components:{
        Pagination
    },

    setup(){
        const destory = (id) => {
            swal({
                title: "هل انت متاكد من الحذف؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                Inertia.delete(route("teacher.destroy", id), {
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

        return {destory}
    }
}
</script>

