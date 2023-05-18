<template>
    <transition name = "route" mode = "out-in" appear>
        <section>
            <h3 class = "mb-5">ویرایش مطلب</h3>

            <div class = "row mt-3">
                <div class = "col-12 mb-3">
<!--                    <div class = "card" v-if = "isDefined" @click = "e => enableClick && makeImageArrays()">-->
                    <div class = "card" v-if = "isDefined" @click = "e => enableClick">
                        <div class = "card-body">
                            <form id = "editForm">
                                <div class = "row">
                                    <div class = "col-12 mb-3">
                                        <label class = "form-label">تصویر شاخص</label><br/>
                                        <image-cropper name = "" caption = "" :hasCaption = "hasCaption" :isRequired = "imgRequired" :aspect = "aspect" :src="data.image"/>
                                        <div id = "imageHelp" class = "form-text error"></div>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "col-md-3 mb-3">
                                        <label for = "title" class = "form-label">عنوان</label>
                                        <input type = "text" :class = "{hasError: errors.title}" class = "form-control" id = "title" :value = "data.title" aria-describedby = "titleHelp" required>
                                        <div id = "titleHelp" class = "form-text error"></div>
                                        <p class = "form-text error m-0" v-for = "e in errors.title">{{ e }}</p>

                                    </div>
                                    <div class = "col-md-3 mb-3">
                                        <label for = "category" class = "form-label">دسته</label>
                                        <select class = "form-select" id = "category" aria-describedby = "categoryHelp" aria-label = "category" required>
                                            <option value = ""></option>
                                            <option :selected = "data.category.id == category.id" v-for = "category in categories" :key = "category.id" :value = "category.id">
                                                {{ category.title }}
                                            </option>
                                        </select>
                                        <div id = "categoryHelp" class = "form-text error"></div>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "col-12 mb-3">
                                        <label class = "form-label">تصویر محصول</label><br/>
                                        <image-cropper name = "product" caption = "" :hasCaption = "hasCaption" :isRequired = "imgRequired" :src="data.image2"/>
                                        <div id = "image2Help" class = "form-text error"></div>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "col-md-3 mb-3">
                                        <label for = "text2" class = "form-label">عنوان محصول</label>
                                        <input type = "text" :class = "{hasError: errors.text2}" class = "form-control" id = "text2" :value = "data.text2" aria-describedby = "text2Help" required>
                                        <div id = "text2Help" class = "form-text error"></div>
                                        <p class = "form-text error m-0" v-for = "e in errors.text2">{{ e }}</p>
                                    </div>
                                    <div class = "col-md-3 mb-3">
                                        <label for = "text3" class = "form-label">زیرنویس</label>
                                        <input type = "text" :class = "{hasError: errors.text3}" class = "form-control" id = "text3" :value = "data.text3" aria-describedby = "text3Help" required>
                                        <div id = "text3Help" class = "form-text error"></div>
                                        <p class = "form-text error m-0" v-for = "e in errors.text3">{{ e }}</p>
                                    </div>
                                    <div class = "col-md-3 mb-3">
                                        <label for = "text4" class = "form-label">با طعم</label>
                                        <input type = "text" :class = "{hasError: errors.text4}" class = "form-control" id = "text4" :value = "data.text4" aria-describedby = "text4Help" >
                                        <div id = "text4Help" class = "form-text error"></div>
                                        <p class = "form-text error m-0" v-for = "e in errors.text4">{{ e }}</p>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "col-md-12 mb-3">
                                        <label class = "form-label" >دستور پخت</label>
                                        <textarea @input = "watchTextAreas" :class = "{hasError: errors.text}" aria-describedby = "textHelp" class = "form-control text-start" id = "text">{{ data.text}}</textarea>
<!--                                        <editor mode = "edit" :content = "data.text" :id = "data.id" />-->

                                        <div id = "textHelp" class = "form-text error"></div>
                                        <p class = "form-text error m-0" v-for = "e in errors.text">{{ e }}</p>

                                    </div>

                                    <div class = "col-md-12 mb-3">
                                        <button class = "btn btn-primary" @click.prevent = "updateInfo" type = "submit">
                                            ویرایش
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
        data() {
            return {
                id: this.$route.params.id,
                data: {},
                categories: [],
                errors: [],
                imgRequired: false,
                hasCaption: false,
                aspect: 388 / 391,
                isDefined: false,
                enableClick: true,
                // tags: [],
            }
        },

        mounted() {


            this.loadCategories();
            this.loadArticle();
        },

        methods: {
            // makeImageArrays() {
            //     document.getElementById('confirm_Image').addEventListener('click',
            //         () => {
            //         if (document.getElementById('Image_inner_code').value !== '') {
            //             this.image_codes.push(document.getElementById('Image_inner_code').value);
            //             this.image_names.push(document.getElementById('Image_inner_name').value);
            //
            //             Editor.methods.updatePreview();
            //             localStorage.setItem('draft_new_img_codes', JSON.stringify(this.image_codes));
            //             localStorage.setItem('draft_new_img_names', JSON.stringify(this.image_names));
            //             console.log(localStorage);
            //             // console.log('11',JSON.stringify(this.image_codes));
            //             // console.log('22',JSON.parse(JSON.stringify(this.image_codes)));
            //
            //         }
            //         //   console.log(this.image_codes, this.image_names);
            //         document.getElementById('btn_clear_image_inner').click();
            //         document.getElementById('Image_inner_caption').value = '';
            //     });
            //     //    console.log('made');
            //     this.enableClick = false;
            //
            // },

            async loadArticle() {
                await axios.get('/api/panel/article/' + this.id)
                    .then((response) => {

                        this.data = response.data;

                        // if (this.data.tags) {
                        //     for (let i = 0; i < JSON.parse(this.data.tags).length; i++) {
                        //         this.tags.push(JSON.parse(this.data.tags)[i]);
                        //     }
                        // }
                    })
                    .then(() => {
                        this.isDefined = true;
                    })
                    .then(() => {
                        this.watchTextAreas();
                    })
                    .catch();
            },
            loadCategories() {
                 axios.get('/api/panel/category/article?page=1&perPage=100000')
                    .then((response) => {
                        this.categories = response.data.data;
                    })
                    .catch();
            },
            async updateInfo() {
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

                    await axios.post('/api/panel/article/' + this.$route.params.id,
                        {
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
                            console.log(response)
                            if (response.status === 200) {
                              setTimeout(() => {
                                    this.$router.push({path: '/panel/article/' + this.id});
                                }, 1000);
                            }
                        })
                        .catch((error) => {
                            if (error.response && error.response.status === 422) {
                                let errorList = Array(error.response.data);
                                for (var i = 0; i < errorList.length; i++) {
                                    this.errors = errorList[i];
                                }
                            } else if (error.response.status === 500) {
                                if (error.response.data.message.includes("SQLSTATE")) {
                                    console.error('خطای پایگاه داده');

                                    async function showAlertSql() {
                                        setTimeout(() => {
                                            alert(error.response.data.message);
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
                        });
                }
            },
            watchTextAreas() {
                let txt = document.querySelector("#text");
                txt?.setAttribute("style", "height:" + (txt.scrollHeight + 20) + "px;overflow-y:hidden;");
                txt?.addEventListener("input", changeHeight, false);

                function changeHeight() {
                    this.style.height = "auto";
                    this.style.height = (this.scrollHeight) + "px";
                }
            },
            addTag() {
                // this.tags.push('{"uri": "", "label": ""}');
            },
            removeTag(index) {
                // this.tags.splice(index, 1)
            },
            updateTags() {
                // this.tags = [];
                // for (let i = 0; i < document.getElementsByName('tagLabel').length; i++) {
                //     this.tags.push({
                //         "label": document.getElementsByName('tagLabel')[i].value.toString(),
                //         "uri": document.getElementsByName('tagUri')[i].value.toString()
                //     });
                // }

            },


        }
    }
</script>
<style>
    span i {
        cursor: pointer;
    }

    .tagElement .uri {
        text-align: left !important;
        font-weight: lighter !important;

    }



    /*@media (min-width: 1200px) {*/
    /*    .modal-xl {*/
    /*        max-width: 1140px;*/
    /*    }*/
    /*}*/

    /*@media (min-width: 992px) {*/
    /*    .modal-lg, .modal-xl {*/
    /*        max-width: 800px;*/
    /*    }*/
    /*}*/

    /*@media (min-width: 576px) {*/
    /*    .modal-dialog {*/
    /*        max-width: 500px;*/
    /*        margin: 1.75rem auto;*/
    /*    }*/
    /*}*/


</style>
