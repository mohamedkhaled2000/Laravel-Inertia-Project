<template lang="">
    <Head title="قائمة الطلاب" />


    <div  class="content-body">

        <div class="container-fluid">
                <div  class="row page-titles mx-0">
                    <div  class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        تاريخ اليوم : {{ date() }}
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
                        <a href="javascript:void(0)">قائمة الطلاب</a>
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
                            <input type="search"  v-model="search2" @keyup="search(id)" class="form-control" placeholder="بحث" style="position: absolute;left:40px;width: auto;"/>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                                <form @submit.prevent="form.post(route('attentance.store'))">
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
                                                            <td class="text-right py-0 align-middle" >
                                                                <div class="input-group" v-if="student.attentance.length <= 0">
                                                                    <label class="form-control text-success">
                                                                        <input type="radio" id="1" v-model="form.attentance[student.id]" value="1"
                                                                            @click="addID(student.grade.id,student.class_room.id)">
                                                                    حضر</label>
                                                                    <label class="form-control text-danger">
                                                                        <input type="radio" id="0" v-model="form.attentance[student.id]" value="0"
                                                                            @click="addID(student.grade.id,student.class_room.id)">
                                                                    غياب</label>
                                                                </div> <!-- --------------------- -->
                                                                <div v-for="att in student.attentance">
                                                                    <div class="input-group" v-if="att.student_id == student.id && new Date(att.date).getDate() >= new Date().getDate()">
                                                                        <label class="form-control text-success" >
                                                                        تم التسجيل</label>
                                                                    </div>
                                                                    <div class="input-group" v-else>
                                                                        <label class="form-control text-success">
                                                                            <input type="radio" id="1" v-model="form.attentance[student.id]" value="1"
                                                                                @click="addID(student.grade.id,student.class_room.id)">
                                                                        حضر</label>
                                                                        <label class="form-control text-danger">
                                                                            <input type="radio" id="0" v-model="form.attentance[student.id]" value="0"
                                                                                @click="addID(student.grade.id,student.class_room.id)">
                                                                        غياب</label>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                </tbody>
                                    </table>
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                        :disabled="form.processing">
                                        تاكيد
                                    </button>
                                </form>
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
import throttle from "lodash/throttle";
export default {
    props:{
        students: Object,
        id: Object,

    },
    components:{
        Pagination
    },
    data(){
        return {
            search2 : '',

            form: this.$inertia.form({
                grade_id : "",
                class_room_id : "",
                section_id : this.id,
                attentance : [],
            }),


        }
    },
    methods:{

        search: throttle(function (id) {
            this.$inertia.replace(this.route('attentance.show',[id,{search: this.search2}]))

        },1000),

        date() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = dd + '-' + mm + '-' + yyyy;
            return today;
        },

        addID(grade,class_room) {
            this.form.grade_id = grade;
            this.form.class_room_id = class_room;
        },

    },


    // setup(){

    //     let form = useForm({
    //         attentance : [],

    //     });

    //     let submit = () => {
    //         form.post(route('attentance.store'), {
    //             preserveScroll: true,
    //         })
    //     }

    //     return {form,submit}
    // }

}
</script>

