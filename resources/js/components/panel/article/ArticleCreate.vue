<template>
    <transition name="route" mode="out-in" appear>
        <section>
            <h3 class="mb-5">ثبت مطلب جدید</h3>

            <div class="row mt-3">
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <form id="editForm" @click = "e => enableClick">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">تصویر</label><br/>
                                        <image-cropper   :isPng="isPng"  name="" caption="" :hasCaption="hasCaption" :isRequired="imgRequired" :aspect="aspect"/>
                                        <div id="imageHelp" class="form-text error"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="title" class="form-label">عنوان</label>
                                        <input type="text" :class="{hasError: errors.title}" class="form-control"
                                               id="title" aria-describedby="titleHelp" required>
                                        <div id="titleHelp" class="form-text error"></div>
                                        <p class="form-text error m-0" v-for="e in errors.title">{{ e }}</p>

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="category" class="form-label">دسته</label>
                                        <select class="form-select" id="category" aria-describedby="categoryHelp"
                                                aria-label="category" required>
                                            <option value=""></option>
                                            <option v-for="category in categories" :key="category.id"
                                                    :value="category.id">
                                                {{ category.title }}
                                            </option>
                                        </select>
                                        <div id="categoryHelp" class="form-text error"></div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">تصویر محصول</label><br/>
                                        <image-cropper   :isPng="isPng"  name="product" caption="" :hasCaption="hasCaption" :isRequired="imgRequired"/>
                                        <div id="image2Help" class="form-text error"></div>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "col-md-3 mb-3">
                                        <label for = "text2" class = "form-label">عنوان محصول</label>
                                        <input type = "text" :class = "{hasError: errors.text2}" class = "form-control" id = "text2" value = "" aria-describedby = "text2Help" required>
                                        <div id = "text2Help" class = "form-text error"></div>
                                        <p class = "form-text error m-0" v-for = "e in errors.text2">{{ e }}</p>
                                    </div>
                                    <div class = "col-md-3 mb-3">
                                        <label for = "text3" class = "form-label">زیرنویس</label>
                                        <input type = "text" :class = "{hasError: errors.text3}" class = "form-control" id = "text3" value = "" aria-describedby = "text3Help" required>
                                        <div id = "text3Help" class = "form-text error"></div>
                                        <p class = "form-text error m-0" v-for = "e in errors.text3">{{ e }}</p>
                                    </div>
                                    <div class = "col-md-3 mb-3">
                                        <label for = "text4" class = "form-label">با طعم</label>
                                        <input type = "text" :class = "{hasError: errors.text4}" class = "form-control" id = "text4" value = "" aria-describedby = "text4Help" >
                                        <div id = "text4Help" class = "form-text error"></div>
                                        <p class = "form-text error m-0" v-for = "e in errors.text4">{{ e }}</p>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" >دستور پخت</label>
<!--                                       <div id="editor"></div>-->

<!--                                        <editor mode = "new" />-->
                                        <textarea @input="watchTextAreas" :class="{hasError: errors.text}"
                                                  aria-describedby="textHelp" class="form-control text-start"
                                                  id="text"></textarea>
                                        <div id="textHelp" class="form-text error"></div>
                                        <p class="form-text error m-0" v-for="e in errors.text">{{ e }}</p>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <button class="btn btn-primary" @click.prevent="createInfo" type="submit">
                                            <!--                                        <button class = "btn btn-primary" type = "submit">-->
                                            ثبت
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

             </section>
    </transition>

</template>

<script>
import ImageCropper from '../../components/ImageCropper';
import App from '../App';
import Editor from "../../components/Editor";

export default {
    components: {Editor, ImageCropper},
    data: function () {
        return {
            id: '',
            blog: [],
            categories: [],
            errors: [],
            imgRequired: true,
            hasCaption: false,
            aspect: 388 / 391,
            isPng: true,

            // tags: [{"label": "", "uri": ""}],
        }
    },
    mounted() {
        this.loadCategories();
    },
    methods: {

        loadCategories() {
             axios.get('/api/panel/category/article?page=1&perPage=100000')
                .then((response) => {
                this.categories = response.data.data;
            }).catch();
        },
        async createInfo() {
            this.errors = [];
            let emptyFieldsCount = 0;
            let req = document.querySelectorAll('[required]');
            req.forEach((element) => {
                if (element.value === "") {
                    element.classList.add('hasError');
                    element.nextSibling.innerHTML = "فیلد اجباری";
                    emptyFieldsCount++;
                } else {
                    element.classList.remove('hasError');
                    element.nextSibling.innerHTML = "";
                }
            });
            if (emptyFieldsCount === 0) {
                await axios.post('/api/panel/article', {
                    image: document.getElementById('Image__code').value,
                    image2: document.getElementById('Image_product_code').value,
                    title: document.getElementById('title').value,
                    article_category_id: document.getElementById('category').value,
                    text:  document.getElementById('text').value,
                    text2:  document.getElementById('text2').value,
                    text3:  document.getElementById('text3').value,
                    text4:  document.getElementById('text4').value,
                    // tags: tags,
                })
                    .then((response) => {
                        console.log(response.data)
                        if (response.status === 201 || response.status === 200) {
                            setTimeout(() => {
                                this.$router.push({path: '/panel/articles'});
                            }, 1000);

                        }
                    })
                    .catch((error) => {
                        if (error.status === 422) {
                            let errorList = Array(error.response.data);
                            for (var i = 0; i < errorList.length; i++) {
                                this.errors = errorList[i];
                            }
                            console.log(this.errors.toString());
                        } else if (error.status === 500) {
                            if (error.response.data.message.includes("SQLSTATE")) {
                                console.error('خطای پایگاه داده');

                                async function showAlertSql() {
                                    setTimeout(() => {
                                        alert(error.data.message);
                                    }, 200);
                                }

                                showAlertSql();
                            } else {
                                async function showAlert500() {
                                    setTimeout(() => {
                                        alert(error.message + ' '
                                            + error.response.data.message);
                                    }, 200);
                                }

                                showAlert500();
                            }
                        } else {

                            async function showAlert() {
                                setTimeout(() => {
                                    alert(error.message);
                                }, 200);
                            }

                            showAlert();
                        }

                    })
            }
        },
        watchTextAreas() {
            let txt = document.querySelector("#text");
            txt.setAttribute("style", "height:" + (txt.scrollHeight + 20) + "px;overflow-y:hidden;");
            txt.addEventListener("input", changeHeight, false);

            function changeHeight() {
                this.style.height = "auto";
                this.style.height = (this.scrollHeight) + "px";
            }
        },



    }
}
</script>
<style>
span i {
    cursor: pointer;
}
</style>
