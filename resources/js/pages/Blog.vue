<template>
  <div>
      <h1>Il mio Blog</h1>
      <div>

            <!-- loader -->
            <div v-if="!loaded" class="text-center mt-5">
               <Loader />
            </div>


        <!-- wrapper posts -->
        <div v-if="loaded">


            <!-- lista posts -->
            <Card
                v-for="post in posts"
                :key="'p'+post.id"
                :title="post.title"
                :category="post.category"
                :date="formatDate(post.date)"
                :content="post.content"
                :slug="post.slug"
            />

            <!-- paginazione -->
            <div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li
                        :class="{'disabled': pagination.current === 1}"
                        class="page-item">
                            <button
                            @click="getPosts(pagination.current - 1)"
                            class="page-link" >&laquo;</button>
                        </li>

                        <li
                        v-for="i in pagination.last"
                        :key="'i'+i"
                        :class="{'active' : pagination.current === i}"
                        class="page-item">
                            <button
                            @click="getPosts(i)"
                             class="page-link">{{ i }}</button></li>


                        <li
                        :class="{'disabled': pagination.current === pagination.last}"
                        class="page-item">
                            <button
                            @click="getPosts(pagination.current + 1)"
                            class="page-link" >&raquo;</button>
                        </li>
                    </ul>
                </nav>
            </div>

            </div>
            <!-- end wrapper posts -->



      </div>
  </div>
</template>

<script>
import axios from 'axios';
import Loader from '../components/Loader.vue';
import Card from '../components/Card.vue';

export default {
    name: 'Blog',
    components: {
        Loader,
        Card,
    },
    data(){
        return{
            posts: [],
            pagination: {},
            loaded: false
        }
    },
    methods:{
        getPosts(page = 1){
            this.loaded = false;
            axios.get('http://127.0.0.1:8000/api/posts',{
                params:{
                    page: page
                }
            })
                .then(res => {
                    console.log(res.data.data);
                    this.posts = res.data.data;
                    this.pagination = {
                        current: res.data.current_page,
                        last: res.data.last_page
                    }
                    this.loaded = true;
                })
                .catch(err => {
                    console.log(err);
                })
        },
        formatDate(date){
            let d = new Date(date);
            let dy = d.getDate();
            let m = d.getMonth() + 1;
            let y = d.getFullYear();
            if(dy < 10) dy = '0' + dy;
            if(m < 10) m = '0' + m;
            return `${dy}/${m}/${y}`;
        }
    },
    created(){
        this.getPosts();
    }
}
</script>

<style>

</style>
