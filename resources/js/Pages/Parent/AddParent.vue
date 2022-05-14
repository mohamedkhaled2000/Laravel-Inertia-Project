<template lang="">

    <Head title="اضافة ولى امر" />

      <!--**********************************
            Content body start
        ***********************************-->
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
                  <a href="javascript:void(0)">اضافة ولى امر</a>
                </li>
              </ol>
            </div>
          </div>
          <!-- row -->
          <div class="row">
            <div class="col-xl-12 col-xxl-12">
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
                        <h5><i class="icon fa fa-check"></i> تم بنجاح!</h5>
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
                        <h5><i class="icon fa fa-ban"></i> خطا!</h5>
                        {{ $page.props.flash.error }}
                    </div>
              <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">

                    <form id="msform" @submit.prevent="submit" >
                            <!-- progressbar -->
                            <ul id="progressbar" style="display: flex;align-items: center;justify-content: center;">
                                <li class="active" id="account" style="float: right;"><strong>بيانات الاب</strong></li>
                                <li id="personal" style="float: right;"><strong>بيانات الام</strong></li>
                                <li id="confirm" style="float: right;"><strong>تاكيد البيانات</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>

                            <div class="form-card" style="text-align: right;">
                                <div class="row">

                                    <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><strong>البريد الالكترونى</strong></label>
                                                <input
                                                    type="email"
                                                    v-model="form.email"
                                                    class="form-control"
                                                />
                                                <div
                                                    v-if="form.errors.email"
                                                    v-text="form.errors.email"
                                                    class="text-danger"
                                                ></div>
                                            </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><strong>كلمة المرور</strong></label>
                                                <input
                                                    type="password"
                                                    v-model="form.password"
                                                    class="form-control"
                                                />
                                                <div
                                                    v-if="form.errors.password"
                                                    v-text="form.errors.password"
                                                    class="text-danger"
                                                ></div>
                                            </div>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><strong>اسم الاب</strong></label>
                                                <input
                                                    type="text"
                                                    v-model="form.father_name"
                                                    class="form-control"
                                                />
                                                <div
                                                    v-if="form.errors.father_name"
                                                    v-text="form.errors.father_name"
                                                    class="text-danger"
                                                ></div>
                                            </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label><strong>وظيفة الاب</strong></label>
                                                <input
                                                    type="text"
                                                    v-model="form.father_job"
                                                    class="form-control"
                                                />
                                                <div
                                                    v-if="form.errors.father_job"
                                                    v-text="form.errors.father_job"
                                                    class="text-danger"
                                                ></div>
                                            </div>
                                    </div>
                                </div>


                                <div class="row">

                                    <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label><strong>رقم الهوية</strong></label>
                                                <input
                                                    type="number"
                                                    v-model="form.father_nation_id"
                                                    class="form-control"
                                                />
                                                <div
                                                    v-if="form.errors.father_nation_id"
                                                    v-text="form.errors.father_nation_id"
                                                    class="text-danger"
                                                ></div>
                                            </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label><strong>رقم جواز السفر</strong></label>
                                                <input
                                                    type="number"
                                                    v-model="form.father_passport_id"
                                                    class="form-control"
                                                />
                                                <div
                                                    v-if="form.errors.father_passport_id"
                                                    v-text="form.errors.father_passport_id"
                                                    class="text-danger"
                                                ></div>
                                            </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label><strong>رقم الهاتف</strong></label>
                                                <input
                                                    type="number"
                                                    v-model="form.father_phone"
                                                    class="form-control"
                                                />
                                                <div
                                                    v-if="form.errors.father_phone"
                                                    v-text="form.errors.father_phone"
                                                    class="text-danger"
                                                ></div>
                                            </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label><strong>الجنسية</strong></label>
                                                <select class="form-control form-control-lg" v-model="form.nationality_father_id ">
                                                    <option v-for="nation in nationality" :value="nation.id">{{nation.name}}</option>
                                                </select>
                                                <div
                                                    v-if="form.errors.nationality_father_id "
                                                    v-text="form.errors.nationality_father_id "
                                                    class="text-danger"
                                                ></div>
                                            </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label><strong>فصيلة الدم</strong></label>
                                                <select class="form-control form-control-lg" v-model="form.boold_type_father_id  ">
                                                    <option v-for="blood in bloods" :value="blood.id">{{blood.name}}</option>
                                                </select>
                                                <div
                                                    v-if="form.errors.boold_type_father_id "
                                                    v-text="form.errors.boold_type_father_id "
                                                    class="text-danger"
                                                ></div>
                                            </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label><strong>الديانة</strong></label>
                                                <select class="form-control form-control-lg" v-model="form.religion_father_id   ">
                                                    <option v-for="religion in religions" :value="religion.id">{{religion.name}}</option>
                                                </select>
                                                <div
                                                    v-if="form.errors.religion_father_id "
                                                    v-text="form.errors.religion_father_id "
                                                    class="text-danger"
                                                ></div>
                                            </div>
                                    </div>

                                </div>


                                <div class="row">

                                    <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label><strong>عنوان الاب</strong></label>
                                                <input
                                                    type="address"
                                                    v-model="form.father_address"
                                                    class="form-control"
                                                />
                                                <div
                                                    v-if="form.errors.father_address"
                                                    v-text="form.errors.father_address"
                                                    class="text-danger"
                                                ></div>
                                            </div>
                                    </div>

                                </div>
                            </div>

                                <input type="button" name="next" class="next action-button"  value="التالى" />
                            </fieldset>

                            <fieldset>
                                <div class="form-card" style="text-align: right;">
                                    <div class="row">

                                        <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label><strong>اسم الام</strong></label>
                                                    <input
                                                        type="text"
                                                        v-model="form.mother_name"
                                                        class="form-control"
                                                    />
                                                    <div
                                                        v-if="form.errors.mother_name"
                                                        v-text="form.errors.mother_name"
                                                        class="text-danger"
                                                    ></div>
                                                </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label><strong>وظيفة الام</strong></label>
                                                    <input
                                                        type="text"
                                                        v-model="form.mother_job"
                                                        class="form-control"
                                                    />
                                                    <div
                                                        v-if="form.errors.mother_job"
                                                        v-text="form.errors.mother_job"
                                                        class="text-danger"
                                                    ></div>
                                                </div>
                                        </div>
                                    </div>


                                    <div class="row">

                                        <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label><strong>رقم الهوية</strong></label>
                                                    <input
                                                        type="number"
                                                        v-model="form.mother_nation_id"
                                                        class="form-control"
                                                    />
                                                    <div
                                                        v-if="form.errors.mother_nation_id"
                                                        v-text="form.errors.mother_nation_id"
                                                        class="text-danger"
                                                    ></div>
                                                </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label><strong>رقم جواز السفر</strong></label>
                                                    <input
                                                        type="number"
                                                        v-model="form.mother_passport_id"
                                                        class="form-control"
                                                    />
                                                    <div
                                                        v-if="form.errors.mother_passport_id"
                                                        v-text="form.errors.mother_passport_id"
                                                        class="text-danger"
                                                    ></div>
                                                </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label><strong>رقم الهاتف</strong></label>
                                                    <input
                                                        type="number"
                                                        v-model="form.mother_phone"
                                                        class="form-control"
                                                    />
                                                    <div
                                                        v-if="form.errors.mother_phone"
                                                        v-text="form.errors.mother_phone"
                                                        class="text-danger"
                                                    ></div>
                                                </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label><strong>الجنسية</strong></label>
                                                    <select class="form-control form-control-lg" v-model="form.nationality_mother_id ">
                                                        <option v-for="nation in nationality" :value="nation.id">{{nation.name}}</option>
                                                    </select>
                                                    <div
                                                        v-if="form.errors.nationality_mother_id "
                                                        v-text="form.errors.nationality_mother_id "
                                                        class="text-danger"
                                                    ></div>
                                                </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label><strong>فصيلة الدم</strong></label>
                                                    <select class="form-control form-control-lg" v-model="form.boold_type_mother_id  ">
                                                        <option v-for="blood in bloods" :value="blood.id">{{blood.name}}</option>
                                                    </select>
                                                    <div
                                                        v-if="form.errors.boold_type_mother_id "
                                                        v-text="form.errors.boold_type_mother_id "
                                                        class="text-danger"
                                                    ></div>
                                                </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label><strong>الديانة</strong></label>
                                                    <select class="form-control form-control-lg" v-model="form.religion_mother_id   ">
                                                        <option v-for="religion in religions" :value="religion.id">{{religion.name}}</option>
                                                    </select>
                                                    <div
                                                        v-if="form.errors.religion_mother_id "
                                                        v-text="form.errors.religion_mother_id "
                                                        class="text-danger"
                                                    ></div>
                                                </div>
                                        </div>

                                    </div>


                                    <div class="row">

                                        <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label><strong>عنوان الام</strong></label>
                                                    <input
                                                        type="address"
                                                        v-model="form.mother_address"
                                                        class="form-control"
                                                    />
                                                    <div
                                                        v-if="form.errors.mother_address"
                                                        v-text="form.errors.mother_address"
                                                        class="text-danger"
                                                    ></div>
                                                </div>

                                    </div>
                                </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="السابق"/>
                                <input type="button" name="next" class="next action-button"  value="التالى"/>
                            </fieldset>
                            <fieldset>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12">

                                        <div class="form-group">
                                                            <label><strong>صورة الهوية</strong></label>
                                                            <input  class="form-control" @input="form.nation_photo = $event.target.files[0]" type="file" />
                                                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                                            {{ form.progress.percentage }}%
                                                            </progress>
                                                            <div
                                                                v-if="form.errors.nation_photo"
                                                                v-text="form.errors.nation_photo"
                                                                class="text-danger"
                                                            ></div>

                                        </div>

                                        <div class="form-group">
                                                            <label><strong>صورة الجواز</strong></label>
                                                            <input  class="form-control" @input="form.pass_photo = $event.target.files[0]" type="file" multiple />
                                                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                                            {{ form.progress.percentage }}%
                                                            </progress>
                                                            <div
                                                                v-if="form.errors.pass_photo"
                                                                v-text="form.errors.pass_photo"
                                                                class="text-danger"
                                                            ></div>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-card" style="text-align: right;">
                                    <h2 class="fs-title text-center">هل انت متاكد من حفظ البيانات؟</h2>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="السابق"/>
                            <button type="submit" class="action-button" style="background:green">تاكيد</button>
                            </fieldset>
                        </form>


                </div>
              </div>
            </div>
          </div>
        </div>
</div>


</template>

<script>
    import { useForm } from "@inertiajs/inertia-vue3";

export default {

    props:{
        bloods:Object,
        nationality:Object,
        religions:Object,
        parents: Object
    },

    setup(){
        let form = useForm({
        email: "",
        password: "",
        father_name: "",
        father_nation_id: "",
        father_passport_id: "",
        father_phone: "",
        father_job: "",
        father_address: "",
        nationality_father_id: "",
        boold_type_father_id : "",
        religion_father_id : "",

        mother_name: "",
        mother_nation_id: "",
        mother_passport_id: "",
        mother_phone: "",
        mother_job: "",
        mother_address: "",
        nationality_mother_id: "",
        boold_type_mother_id : "",
        religion_mother_id : "",

        pass_photo : "",
        nation_photo : "",
    });

    let submit = () => {

        form.post(route('parent.store'), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
        })
    }
    return {form, submit}

    }

}
</script>


