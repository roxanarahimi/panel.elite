<template>
    <transition name = "route" mode = "out-in" appear>
        <section class = "" v-if = "data">
            <div class = "index_image">
             <img class = "img-fluid mb-2" :src = "data.image" width="350" alt = "">
                <div class = "label">
                   <span class = "badge bg-danger">
                       <i class = "bi bi-tags-fill ms-2"></i>
                       <b v-if = "data.category">  {{ data.category.title}}</b>
               </span>
                </div>
            </div>

          <div class="d-inline-block">
            <h3 class = "mb-2 fw-bold  ">{{data.title}}</h3>
            <h3 class = "mb-2 fw-bold ">{{data.title_en}}</h3>
            <h3 class = "mb-2 fw-bold">{{data.title_ar}}</h3>
          </div>


            <router-link :to = "'/panel/edit/article/'+data.id" class = "text-dark">
                <span title = "ویرایش دستور پخت" class = "mx-3 p-2 d-inline-block align-middle bg-dark text-light rounded-circle">
                    <i class = "bi bi-pencil p-0 edit-pen"></i>
                </span>
            </router-link>


            <div class = "row mt-3">
                <div class = "col-lg-6 mb-3">
                    <div class = "card h-100">
                        <div class = "card-body p-md-5">
                            <h3  class="mb-5">محصول:</h3>
                            <h3 v-if="data.product">{{ data.product.title }}</h3>
                            <img v-if="data.product" class = "img-fluid mb-2" :src = "data.product.image" width="350" alt = "">
                            <h3 v-if="data.product">{{ data.product.title_en }}</h3>
                            <h4 v-if="data.product">{{ data.product.subTitle }}</h4>
                            <h6 v-if="data.product">{{ data.product.flavor }}</h6>
                        </div>
                    </div>
                </div>
                <div class = "col-lg-6 mb-3">
                    <div class = "card h-100">
                        <div class = "card-body p-md-5">
                            <h3 class="mb-5">دستور پخت:</h3>

                            <div id = "text" style="font-size: 18px;white-space: pre-line; text-align: right !important" class = "mb-5"></div>
<!--                            <div>-->
<!--                                <span v-for = "tag in tags" :key = "tag" :title = "tag.uri" class = "btn btn-sm btn-outline-dark m-1"> {{ tag.label }} </span>-->
<!--                            </div>-->

                          <b class="">دستور پخت پیشنهادی:</b>
                          <a class="mx-2" :href="'/panel/article/'+data.tag?.id">{{ data.tag?.title}}</a>
                        </div>
                    </div>
                </div>
                <div class = "col-lg-6 mb-3">
                    <div class = "card h-100">
                        <div class = "card-body p-md-5">
                            <h3 class="mb-5">دستور پخت انگلیسی:</h3>
                            <div id = "text_en" style="font-size: 18px;white-space: pre-line; text-align: right !important" class = "mb-5"></div>
                        </div>
                    </div>
                </div>
                <div class = "col-lg-6 mb-3">
                    <div class = "card h-100">
                        <div class = "card-body p-md-5">
                            <h3 class="mb-5">دستور پخت عربی:</h3>

                            <div id = "text_ar" style="font-size: 18px;white-space: pre-line; text-align: right !important" class = "mb-5"></div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <div v-else><p class = "fw-bold">این مطلب موجود نیست</p></div>

    </transition>


</template>

<script>
    import App from '../App';

    export default {
        data: function () {
            return {
                data: {},
                id: this.$route.params.id,
                tags: [],

            }
        },
        mounted() {
            this.loadArticle();
        },
        methods: {
           async loadArticle() {
               await axios.get('/api/panel/article/' + this.id)
                            .then((response) => {
                                this.data = response.data;
                                document.getElementById('text').innerHTML = this.data.text;
                                document.getElementById('text_en').innerHTML = this.data.text_en;
                                document.getElementById('text_ar').innerHTML = this.data.text_ar;

                                // if (this.data.tags) {
                                //     for (let i = 0; i < JSON.parse(this.data.tags).length; i++) {
                                //         this.tags.push(JSON.parse(this.data.tags)[i]);
                                //     }
                                // }
                            })
                            .catch();
            },

        }
    }
</script>
<style>
    #content p {
        text-align: justify !important;
        line-height: 30px !important;
        padding-left: 10px;

    }

    #content figure {
        text-align: center !important;
        display: block !important;
    }

    #content figure figcaption {
        text-align: center !important;
    }

    .index_image .label {
        display: block;
        font-size: 20px;
        margin: -50px 20px 50px 20px;
    }

    #content figure img {
        max-width: 100%;
    }
    .edit-pen {
        font-size: 12px;
        margin: 0 6px !important;
    }
</style>
