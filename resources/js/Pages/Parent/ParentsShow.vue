<template lang="">
    <Head title="اولياء الامور" />


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
                        <a href="javascript:void(0)">اولياء الامور</a>
                        </li>
                    </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <Link :href="route('parent.add')" class="btn btn-success">اضافة ولى امر</Link>
                        </div>
                        <div class="card-body">


                            <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>البريد الالكترونى</th>
                                                <th>اسم الاب</th>
                                                <th>رقم هوية الاب</th>
                                                <th>رقم جواز السفر</th>
                                                <th>رقم هاتف الاب</th>
                                                <th>وظيفة الاب</th>
                                                <th>العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(parent, i) in parents.data">
                                                <td>{{ ++i }}</td>
                                                <td>{{ parent.email }}</td>
                                                <td>{{ parent.father_name }}</td>
                                                <td>{{ parent.father_nation_id }}</td>
                                                <td>{{ parent.father_passport_id }}</td>
                                                <td>{{ parent.father_phone }}</td>
                                                <td>{{ parent.father_job }}</td>
                                                <td class="text-right py-0 align-middle">
                                                    <div class="btn-group btn-group-sm">
                                                        <Link :href="route('parent.edit',parent.id)" class="btn btn-info"><i class="fa fa-edit"></i
                                                        ></Link>
                                                        <button
                                                            type="button"
                                                            @click="destoryP(parent.id)"
                                                            class="btn btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                            </table>
                        <Pagination :links="parents.links"/>

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
        parents: Object
    },
    components:{
        Pagination
    },

    setup(){
        const destoryP = (id) => {

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

                    Inertia.delete(route('parent.delete',id),{
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

        return {destoryP}
    }
}
</script>

