<template>
    <!--<h3>داشبورد</h3>-->
    <transition name="route" mode="out-in" appear>
        <section>
            <h3 class="mb-5 pb-5">جدید ترین مطالب</h3>

            <Suspense>
                <template #default>
                  <div class="row">
                      <router-link class="col-3 mb-3" :to="'/panel/article/'+item.id" :key="item.id" v-for="item in articles" >
                          <div class="card">
                              <div class="card-body">
                                  <img :src="item.image" class="img-fluid" alt="">
                                  <p>{{ item.title }}</p>
                              </div>
                          </div>
                      </router-link>
                  </div>

                </template>
                <template #fallback>
                    <loader class="mt-5"/>
                </template>
            </Suspense>

            <!--            <Suspense>-->
<!--                <template #default>-->
<!--                    <day-report-cards/>-->
<!--                </template>-->
<!--                <template #fallback>-->
<!--                    <loader class="mt-5"/>-->
<!--                </template>-->
<!--            </Suspense>-->

<!--            <Suspense>-->
<!--                <template #default>-->
<!--                    <latest-products/>-->
<!--                </template>-->
<!--                <template #fallback>-->
<!--                    <loader class="mt-5"/>-->
<!--                </template>-->
<!--            </Suspense>-->
            <p id="msg"></p>
        </section>
    </transition>
</template>
<script>
import App from './App';
import Loader from '../components/Loader';
import {onMounted, ref} from "vue";
import LatestProducts from "./dashboard/LatestProducts";
import DayReportCards from "./dashboard/DayReportCards";

export default {
    components: {LatestProducts, App, Loader, DayReportCards},
    setup() {
        const articles = ref({});
        const loadArticles= ()=>{
            axios.get('/api/panel/article?page=1&perPage=4')
                .then((response) => {
                    articles.value = response.data.data;


                })
                .catch();
        }
        onMounted(() => {
            document.querySelector('#admin_label').innerHTML = JSON.parse(localStorage.getItem('admin')).name;
            loadArticles();

        });
        return { articles, loadArticles}
    },


}

</script>
<style>
#spin {
    /*margin: 20px;*/
    /*width: 100px;*/
    /*height: 100px;*/
    /*background: #f00;*/
    -webkit-animation-name: spin;
    -webkit-animation-duration: 1500ms;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    -moz-animation-name: spin;
    -moz-animation-duration: 1500ms;
    -moz-animation-iteration-count: infinite;
    -moz-animation-timing-function: linear;
    -ms-animation-name: spin;
    -ms-animation-duration: 1500ms;
    -ms-animation-iteration-count: infinite;
    -ms-animation-timing-function: linear;

    animation-name: spin;
    animation-duration: 1500ms;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}

@-moz-keyframes spin {
    from {
        -moz-transform: rotate(0deg);
    }
    to {
        -moz-transform: rotate(360deg);
    }
}

@-webkit-keyframes spin {
    from {
        -webkit-transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.pointer {
    cursor: pointer;
}
</style>
