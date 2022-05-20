<template lang="">
    <Head :title="student.name" />

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
                        <a href="javascript:void(0)">{{student.name}}</a>
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

                            <div class="card">
                                <h5 class="card-header">بيانات الطالب</h5>
                                <div class="card-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>اسم الطالب</th>
                                                <td>{{ student.name }}</td>
                                                <th>البريد الالكترونى</th>
                                                <td>{{ student.email }}</td>
                                                <th>النوع</th>
                                                <td>{{ student.gender == 1 ? 'ذكر' : 'انثى' }}</td>
                                                <th>الجنسية</th>
                                                <td>{{ student.nationality.name }}</td>
                                            </tr>
                                            <tr>
                                                <th>فصيلة الدم</th>
                                                <td>{{ student.type_boold.name }}</td>
                                                <th>المرحلة الدراسية</th>
                                                <td>{{ student.grade.name }}</td>
                                                <th>الصف الدراسى</th>
                                                <td>{{ student.class_room.class_name }}</td>
                                                <th>القسم</th>
                                                <td>{{ student.section.section_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>تاريخ الميلاد</th>
                                                <td>{{ student.date_brith }}</td>
                                                <th>ولى الامر</th>
                                                <td>{{ student.parent.parent_name }}</td>
                                                <th>السنة الدراسية</th>
                                                <td>{{ student.academic_year }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <div class="card">
                                <h5 class="card-header">مرفقات الطالب</h5>

                                <div class="card-title">
                                    <form @submit.prevent="submit">
                                        <div class="form-group">
                                            <label>المرفقات</label>
                                            <div class="fallback">
                                                <input @input="form.images = $event.target.files" type="file" accept="image/*" multiple />
                                            </div>
                                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                                {{ form.progress.percentage }}%
                                            </progress>
                                        </div>

                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                            :disabled="form.processing">
                                            اضافة
                                        </button>
                                    </form>

                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">اسم الملف</th>
                                            <th scope="col">تاريخه</th>
                                            <th scope="col">العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(img,i) in student.images">
                                                <th scope="row">{{++i}}</th>
                                                <td>{{img.url.split("/").pop()}}</td>
                                                <td>{{ img.created_at.split("T")[0] }}</td>
                                                <td>
                                                    <a :href="'/Std/'+student.name+'/'+img.url.split('/').pop()" class="btn btn-success"><i class="fa fa-download" title="تحميل"></i></a>
                                                    <button
                                                        type="button"
                                                        @click="destory(img.id)"
                                                        class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                </div>
            </div>

</div>

</template>
<script>
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import swal from 'sweetalert';
export default {

    props:{
        student : Object
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

                    Inertia.delete(route('deleteStudAtt',id),{
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

        let form = useForm({
            name: props.student.name,
            id: props.student.id,
            images: [],

        });

        let submit = () => {
            form.post(route('upload_new_att'), {
                preserveScroll: true,
                onSuccess: () => form.reset(),
            })
        }

        return {form,submit,destory}
    }
}
</script>


<style scope>
.card{
    margin-bottom: -5rem;
}
</style>
