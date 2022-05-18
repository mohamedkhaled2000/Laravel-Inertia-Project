<template lang="">
    <Head title="الصفوف الدراسية" />

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0"></div>
                <div
                    class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex"
                >
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <Link href="/">الرئيسية</Link>
                        </li>
                        <li class="breadcrumb-item active">الصفوف الدراسية</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div
                        v-if="$page.props.flash.message"
                        class="alert alert-success alert-dismissible"
                    >
                        <button
                            type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-hidden="true"
                        >
                            ×
                        </button>
                        <h5><i class="icon fas fa-check"></i> تم بنجاح!</h5>
                        {{ $page.props.flash.message }}
                    </div>

                    <div
                        v-if="$page.props.flash.error"
                        class="alert alert-danger alert-dismissible"
                    >
                        <button
                            type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-hidden="true"
                        >
                            ×
                        </button>
                        <h5><i class="icon fas fa-ban"></i> خطا!</h5>
                        {{ $page.props.flash.error }}
                    </div>

                    <div class="card-header">
                        <!-- Button trigger modal -->
                        <button
                            type="button"
                            class="btn btn-success"
                            data-toggle="modal"
                            data-target="#staticBackdrop"
                        >
                            اضافة صف
                        </button>
                    </div>

                    <button
                        type="button"
                        @click="delete_all(checkname)"
                        class="btn btn-danger"
                    >
                        حذف المحدد
                    </button>
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 10px"></th>
                                        <th style="width: 10px">#</th>
                                        <th>اسم الصف</th>
                                        <th>اسم المرحلة</th>
                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(classRom, i) in classes">
                                        <td>
                                            <input
                                                type="checkbox"
                                                :value="classRom.id"
                                                v-model="checkname"
                                            />
                                        </td>
                                        <td>{{ ++i }}</td>
                                        <td>{{ classRom.class_name }}</td>
                                        <td>{{ classRom.grade.name }}</td>
                                        <td
                                            class="text-right py-0 align-middle"
                                        >
                                            <div class="btn-group btn-group-sm">
                                                <Link
                                                    :href="
                                                        route(
                                                            'class.edit',
                                                            classRom.id
                                                        )
                                                    "
                                                    class="btn btn-info"
                                                    ><i class="fa fa-edit"></i
                                                ></Link>
                                                <button
                                                    type="submit"
                                                    @click="
                                                        destory(classRom.id)
                                                    "
                                                    class="btn btn-danger"
                                                >
                                                    <i class="fa fa-trash"></i>
                                                </button>
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


    <!-- Modal -->
    <div
        class="modal fade"
        id="staticBackdrop"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة صف</h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form
                        role="form"
                        @submit.prevent="form.post(route('class.store'))"
                    >
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم الصف</label>
                            <input
                                v-model="form.class_name"
                                type="text"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                            />
                            <div
                                v-if="form.errors.class_name"
                                v-text="form.errors.class_name"
                                class="text-danger"
                            ></div>
                        </div>

                        <div class="form-group">
                            <label>اختير المرحلة الدراسية</label>
                            <select
                                v-model="form.grade_id"
                                class="form-control"
                                style="width: 100%"
                            >
                                <option
                                    v-for="grade in grades"
                                    :value="grade.id"
                                >
                                    {{ grade.name }}
                                </option>
                            </select>
                            <div
                                v-if="form.errors.grade_id"
                                v-text="form.errors.grade_id"
                                class="text-danger"
                            ></div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal"
                            >
                                اغلاق
                            </button>
                            <button
                                type="submit"
                                class="btn btn-primary"
                                :disabled="form.processing"
                            >
                                اضافة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import swal from "sweetalert";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    props: {
        classes: Object,
        grades: Object,
        flash: String,
    },
    data() {
        return {
            checkname: [],
        };
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
                    Inertia.delete(route("class.delete", id), {
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
            class_name: "",
            grade_id: "",
        });

        const delete_all = (checkname) => {
            if (checkname.length > 0) {
                swal({
                    title: "هل انت متاكد من الحذف؟",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        Inertia.post(route("delete_all", Array(checkname)), {
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
            } else {
                swal("قم باختيار الصفوف التى تريد حذفها");
            }
        };

        return { destory, form, delete_all };
    },
};
</script>
