<template>
    <transition name="route" mode="out-in" appear>
        <section class="" style="text-align: justify">
            <div class="row " v-if="data.id" >
                <div class="col-12 ">
                    <div class="row px-3 ">
                        <div class="col-12 mb-3 " :style="{ backgroundImage: 'linear-gradient(to right,'+data.color+',white, transparent)'  }">
                            <div class="d-inline-block mt-5"  >
                                <div class="ind">
                                    <img class="img-fluid mb-2" :src="data.image" width="350" alt="">
                                    <div class="label">
                                        <span class="badge bg-danger">
                                            <i class="bi bi-tags-fill ms-2"></i>
                                            <b v-if="data.category">  {{ data.category.title }}</b>
                                        </span>
                                    </div>
                                </div>
                                <h3 class="mb-2 fw-bold d-block">{{ data.title }}</h3>
                                <h3 class="mb-2 fw-bold d-block">{{ data.title_en }}</h3>
                                <h3 class="mb-2 fw-bold d-block">{{ data.title_ar }}</h3>
                            </div>
                            <router-link :to="'/panel/edit/product/'+data.id" class="text-dark">
                <span title="ویرایش محصول"
                      class="mx-3 p-2 d-inline-block align-middle bg-dark text-light rounded-circle">
                    <i class="bi bi-pencil p-0 edit-pen"></i>
                </span>
                            </router-link>
                        </div>
                    </div>
                </div>
                <div class="row">

                </div>

                <div class="col-xxl-12 mb-5 ">
                    <div class="card h-100">
                        <div class="card-body p-md-5 ">
                            <div class="d-md-flex justify-content-md-between flex-row-reverse">
                                <p>{{ data.title_en }}</p>
                                <p>{{ data.subTitle }}</p>
                                <p>{{ data.flavor }}</p>
                            </div>
                          <div class="d-md-flex justify-content-md-between flex-row-reverse">
                            <p>{{ data.tag1 }}</p>
                            <p>{{ data.tag1_en }}</p>
                            <p>{{ data.tag1_ar }}</p>
                          </div>
                          <div class="d-md-flex justify-content-md-between flex-row-reverse">
                            <p>{{ data.tag2 }}</p>
                            <p>{{ data.tag2_en }}</p>
                            <p>{{ data.tag2_ar }}</p>
                          </div>
                          <div class="">
                                <p>لینک خرید: {{ data.link }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5 ">
                    <div class="card h-100">
                        <div class="card-body p-md-5 ">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5  class="mb-5">ارزش غذایی</h5>
                                    <table v-if="data.features">
                                        <tbody>
                                        <tr v-for="item in features" :key="item.id">
                                            <th>{{ item.label }}:</th>
                                            <td class="text-center">{{ item.unit }}</td>
                                            <td class="text-center">{{ item.value }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="card h-100">
                        <div class="card-body p-md-5">
                            <h5 class="mb-5">ویژگی</h5>
                            <div id="text"  style="font-size: 18px;white-space: pre-line; text-align: right !important"  class="mb-5" >
                                {{ data.text }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="card h-100">
                        <div class="card-body p-md-5">
                            <h5 class="mb-5">ویژگی انگلیسی</h5>
                            <div id="text"  style="font-size: 18px;white-space: pre-line; text-align: right !important"  class="mb-5" >
                                {{ data.text_en }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="card h-100">
                        <div class="card-body p-md-5">
                            <h5 class="mb-5">ویژگی عربی</h5>
                            <div id="text"  style="font-size: 18px;white-space: pre-line; text-align: right !important"  class="mb-5" >
                                {{ data.text_ar }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else><p class="fw-bold">این محصول موجود نیست</p></div>

        </section>

    </transition>

</template>

<script>
import App from '../App';
import Draggable from "vuedraggable";
import Images from "../../components/Images";

export default {
    components: {App, Draggable, Images},
    data: function () {
        return {
            data: {},
            id: this.$route.params.id,
            features: [],
            images: [],
        }
    },
    mounted() {
        this.loadProduct();

    },
    methods: {
        async loadProduct() {

            await axios.get('/api/panel/product/' + this.id)
                .then((response) => {
                    this.data = response.data.product;
                    // if (document.querySelector('#text')) {
                    //     document.querySelector('#text').innerText = this.data.text;
                    // }
                    if (this.data.features) {
                        this.features = [];
                        for (let i = 0; i < JSON.parse(this.data.features).length; i++) {
                            this.features.push(JSON.parse(this.data.features)[i]);
                        }
                    }
                    if (this.data.images) {
                        for (let i = 0; i < this.data.images.length; i++) {
                            this.images.push([i, this.data.images[i]]);
                        }
                    }
                });

        },
        async updateOrder() {

            let newOrder = await [];
            newOrder = await document.querySelectorAll('[name = "order"]');
            await console.log('nnn', newOrder);
            let list = '';
            for (let i = 0; i < newOrder.length; i++) {
                list += newOrder[i].value + ',';
            }
            // },1000);

            axios.post('/api/panel/images/reorder/product/' + this.id, {images: list})
                .then((response) => {
                    console.log('res', response);
                    if (response.status === 200) {
                        this.loadProduct();
                    }
                })
                .catch((error) => {
                    console.log(error);
                });


        }

    }
}
</script>
<style scoped>
.color-span {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    margin-bottom: -5px;
}

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
    margin: -50px 20px 20px 20px !important;
}

#content figure img {
    max-width: 100%;
}

/*.index_image span{*/
/*    display: inline-block;*/
/*    right:20px;*/
/*    bottom: 20px;*/
/*}*/
.edit-pen {
    font-size: 12px;
    margin: 0 6px !important;
}

.element-cards {
    /*box-shadow: none;*/
    /*background-color: transparent;*/
}

.moving-card {
    opacity: 1 !important;
    background-color: whitesmoke;
    border: dotted dimgray !important;
    box-shadow: none;

}

th, td {
    padding: 10px;
    min-width: 100px;
}
</style>
