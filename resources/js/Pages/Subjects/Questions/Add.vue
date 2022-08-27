<template lang="">
    <Head title="اضافة سؤال جديد" />

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
                            <li class="breadcrumb-item active">اضافة سؤال جديد</li>

                        </ol>
                        </div>
                    </div>


                <div class="row">
                    <div class="col-12">


                    <div class="card card-primary">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" @submit.prevent="submit">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">اسم السؤال</label>
                                            <input v-model="form.title" type="text" class="form-control">
                                            <div v-if="form.errors.title" v-text="form.errors.title" class="text-danger"></div>
                                        </div>
                                    </div>


                                    <!-- <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الاجابات</label>
                                            <div class="bs-example">
                                                <p>Message is: {{ text }}</p>
                                                <input type="text" :value="text" @input="event => text = event.target.value" data-role="tagsinput" style="display: none;">
                                            </div>
                                            <div v-if="form.errors.answers" v-text="form.errors.answers" class="text-danger"></div>
                                        </div>
                                    </div> -->

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الاجابة 1</label>
                                            <input :value="" v-model="form.answers[0]" type="text" class="form-control">
                                            <div v-if="form.errors.answer" v-text="form.errors.answer" class="text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الاجابة 2</label>
                                            <input :value="" v-model="form.answers[1]" type="text" class="form-control">
                                            <div v-if="form.errors.answer" v-text="form.errors.answer" class="text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الاجابة 3</label>
                                            <input :value="" v-model="form.answers[2]" type="text" class="form-control">
                                            <div v-if="form.errors.answer" v-text="form.errors.answer" class="text-danger"></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الاجابة الصحيحة</label>
                                            <input v-model="form.right_answer" type="text" class="form-control">
                                            <div v-if="form.errors.right_answer" v-text="form.errors.right_answer" class="text-danger"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>اسم الاختبار</label>
                                            <select
                                                v-model="form.exam_id"
                                                class="form-control"
                                                style="width: 100%"
                                                required>
                                                <option
                                                    v-for="exam in exams"
                                                    :value="exam.id" >
                                                    {{ exam.name }}
                                                </option>
                                            </select>
                                            <div
                                                v-if="form.errors.exam_id"
                                                v-text="form.errors.exam_id"
                                                class="text-danger"
                                            ></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">الدرجة</label>
                                            <input v-model="form.score" type="number" class="form-control">
                                            <div v-if="form.errors.score" v-text="form.errors.score" class="text-danger"></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" :disabled="form.processing">تاكيد</button>
                            </div>
                        </form>
                    </div>

                    </div>
                </div>
            </div>

        </div>


</template>
<script>
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    props:{
        exams : Object,
    },

    setup(){

        let form = useForm({
            title :"",
            answers : [],
            right_answer :"",
            score :"",
            exam_id :"",
        });

        let submit = () => {
            form.post(route('question.store'), {
                preserveScroll: true,
                onSuccess: () => form.reset(),
            })
        }

        return {form,submit}
    }
}
</script>

